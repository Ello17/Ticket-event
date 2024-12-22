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
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">No</th>
                            <th scope="col">Ticket Purchased</th>
                            <th scope="col">Ticket Category</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Total Transactions</th>
                            <th scope="col">Full name</th>
                            <th scope="col">No-KTP</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksiList as $index => $transaksi)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $index + 1 }}</th>
                            <td>{{ $transaksi->tiket_dibeli }}</td>
                            <td>{{ $transaksi->tiket->kategori_tiket }}</td>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                            <td>{{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->nama_lengkap }}</td>
                            <td>{{ $transaksi->no_ktp }}</td>
                            <td>{{ $transaksi->no_telepon }}</td>
                            <td>{{ $transaksi->email }}</td>
                            <td>{{ $transaksi->status }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if($transaksi->status === 'paid')
                                        @if($transaksi->tiket->kategori_tiket === 'online')
                                            <a href="{{ $transaksi->tiket->link_tiket }}" 
                                               class="btn btn-success btn-sm" 
                                               target="_blank" 
                                               rel="noopener noreferrer">Join Zoom</a>
                                        @endif
                                        <a href="{{ route('downloadTiket', $transaksi->id) }}" 
                                           class="btn btn-primary btn-sm">Download</a>
                                    @elseif($transaksi->status === 'pending')
                                        <a href="" 
                                           class="btn btn-warning btn-sm">Lanjutkan Pembayaran</a>
                                    @else
                                        <form action="{{ route('destroyTransaksi', $transaksi->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                         </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-3">
                                <strong>No tickets purchased yet</strong>
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
