<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IncomingItem;
use App\Models\Item;
use App\Models\OutgoingItem;
use App\Models\Supplier;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard.index', [
            'totalBarang' => Item::query()->count(),
            'totalKategori' => Category::query()->count(),
            'totalSupplier' => Supplier::query()->count(),
            'totalBarangMasuk' => IncomingItem::query()->sum('jumlah'),
            'totalBarangKeluar' => OutgoingItem::query()->sum('jumlah'),
            'totalStok' => Item::query()->sum('stok'),
            'lowStockItems' => Item::query()->with(['category', 'supplier'])->where('stok', '<', 10)->orderBy('stok')->get(),
        ]);
    }
}
