<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Listar todas las facturas
    public function index()
    {
        return Invoice::with(['client', 'products'])->get();
    }

    // Mostrar factura específica
    public function show(Invoice $invoice)
    {
        return $invoice->load(['client', 'products']);
    }

    // Crear factura
    // Crear factura
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0', // asegura precio válido
            'status' => 'nullable|in:pending,paid,cancelled', // estado válido
        ]);

        // Crear factura
        $invoice = Invoice::create([
            'client_id' => $request->client_id,
            'total' => 0,
            'status' => $request->status ?? 'pending',
        ]);

        // Adjuntar productos y calcular total
        $total = 0;
        foreach ($request->products as $prod) {
            $invoice->products()->attach($prod['id'], [
                'quantity' => $prod['quantity'],
                'price' => $prod['price'],
            ]);
            $total += $prod['quantity'] * $prod['price'];
        }

        // Actualizar total
        $invoice->update(['total' => $total]);

        // Devolver factura con relaciones
        return $invoice->load('products');
    }
    // Actualizar factura
    public function update(Request $request, Invoice $invoice)
    {
        // Validaciones
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled', // solo estados válidos
            'products' => 'sometimes|array|min:1',            // opcional: actualizar productos
            'products.*.id' => 'required_with:products|exists:products,id',
            'products.*.quantity' => 'required_with:products|integer|min:1',
            'products.*.price' => 'required_with:products|numeric|min:0',
        ]);

        // Actualizar estado
        $invoice->update($request->only('status'));

        // Si vienen productos, actualizar pivot y total
        if ($request->has('products')) {
            $invoice->products()->detach(); // eliminar antiguos
            $total = 0;
            foreach ($request->products as $prod) {
                $invoice->products()->attach($prod['id'], [
                    'quantity' => $prod['quantity'],
                    'price' => $prod['price'],
                ]);
                $total += $prod['quantity'] * $prod['price'];
            }
            $invoice->update(['total' => $total]);
        }

        // Devolver factura con relaciones
        return $invoice->load(['client', 'products']);
    }

    // Eliminar factura
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(['message' => 'Invoice deleted']);
    }
}
