@extends('layouts.app')
@section('title', 'Laporan Barang')
@section('actions')<a href="{{ route('reports.barang.print') }}" target="_blank" class="btn btn-outline-secondary"><i class="bi bi-printer me-1"></i>Print</a> <a href="{{ route('reports.barang.excel') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel me-1"></i>Excel</a> <a href="{{ route('reports.barang.pdf') }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf me-1"></i>PDF</a>@endsection
@section('content')
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-bordered table-striped mb-0 datatable"><thead><tr><th>Kode</th><th>Nama</th><th>Kategori</th><th>Supplier</th><th>Stok</th><th>Satuan</th></tr></thead><tbody>@foreach($items as $item)<tr><td>{{ $item->kode_barang }}</td><td>{{ $item->nama_barang }}</td><td>{{ $item->category->nama_kategori }}</td><td>{{ $item->supplier->nama_supplier }}</td><td>{{ $item->stok }}</td><td>{{ $item->satuan }}</td></tr>@endforeach</tbody></table></div></div>
@endsection
