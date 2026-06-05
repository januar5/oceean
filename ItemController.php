<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(Request $request): View
    {
        $items = Item::query()
            ->with(['category', 'supplier'])
            ->when($request->search, function ($query, $search) {
                $query->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhereHas('category', fn ($q) => $q->where('nama_kategori', 'like', "%{$search}%"))
                    ->orWhereHas('supplier', fn ($q) => $q->where('nama_supplier', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('items.index', compact('items'));
    }

    public function create(): View
    {
        return view('items.create', [
            'categories' => Category::query()->orderBy('nama_kategori')->get(),
            'suppliers' => Supplier::query()->orderBy('nama_supplier')->get(),
        ]);
    }

    public function store(ItemRequest $request): RedirectResponse
    {
        Item::query()->create($request->validated());

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Item $item): View
    {
        $item->load(['category', 'supplier', 'incomingItems', 'outgoingItems']);

        return view('items.show', compact('item'));
    }

    public function edit(Item $item): View
    {
        return view('items.edit', [
            'item' => $item,
            'categories' => Category::query()->orderBy('nama_kategori')->get(),
            'suppliers' => Supplier::query()->orderBy('nama_supplier')->get(),
        ]);
    }

    public function update(ItemRequest $request, Item $item): RedirectResponse
    {
        $item->update($request->validated());

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        // 1. Hapus transaksi masuk dan keluar yang terkait dengan barang ini
        $item->incomingItems()->delete();
        $item->outgoingItems()->delete();

        // 2. Hapus barang
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang beserta seluruh riwayat transaksi terkait berhasil dihapus.');
    }
}
