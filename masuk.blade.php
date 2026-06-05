@extends('layouts.app')
@section('title', 'Laporan Barang Masuk')
@section('content')
@include('reports.filter', ['printRoute' => route('reports.masuk.print'), 'pdfRoute' => route('reports.masuk.pdf'), 'excelRoute' => route('reports.masuk.excel')])
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-bordered table-striped mb-0 datatable"><thead><tr><th>Tanggal</th><th>Kode</th><th>Barang</th><th>Jumlah</th><th>Keterangan</th></tr></thead><tbody>@foreach($data as $row)<tr><td>{{ $row->tanggal->format('d/m/Y') }}</td><td>{{ $row->item->kode_barang }}</td><td>{{ $row->item->nama_barang }}</td><td>{{ $row->jumlah }}</td><td>{{ $row->keterangan }}</td></tr>@endforeach</tbody></table></div></div>
@endsection
