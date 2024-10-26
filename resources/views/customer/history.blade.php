@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('components/css/history.css') }}">
@endpush

@section('title', 'History')

@section('content')
<div class="title py-3">
    <h1>HISTORY</h1>
</div>
<div class="container py-2">
    <div class="row">
        <div class="col-lg-9 mx-auto bg-[#1f2937] rounded shadow">

            <!-- Fixed header table-->
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">No</th>
                            <th scope="col">Tiket Dibeli</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Total Transaksi</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">No-KTP</th>
                            <th scope="col">No-Telepon</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiList as $index => $transaksi)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $index + 1 }}</th>
                            <td>{{ $transaksi->tiket_dibeli }}</td>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                            <td>{{ $transaksi->total_transaksi }}</td>
                            <td>{{ $transaksi->nama_lengkap }}</td>
                            <td>{{ $transaksi->no_ktp }}</td>
                            <td>{{ $transaksi->no_telepon }}</td>
                            <td>{{ $transaksi->email }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                <strong>Belum ada Tiket dibeli</strong>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush
