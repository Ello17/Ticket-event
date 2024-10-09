@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{asset('components/css/history.css')}}">
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
                            <th scope="col">No</th>
                            <th scope="col">Tiket Dibeli</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Jumlah Tiket</th>
                            <th scope="col">Total Transaksi</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">No-KTP</th>
                            <th scope="col">No-Telepon</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td >Otto</td>
                            <td >@mdo</td>
                            <td >@mdo</td>
                            <td >@mdo</td>
                            <td >@mdo</td>
                            <td >@mdo</td>
                            <td >@mdo</td>
                        </tr>
                        {{-- <tr>
                            <th scope="row" class="col-1">2</th>
                            <td class="col-1">Jacob</td>
                            <td class="col-1">Thornton</td>
                            <td class="col-1">@fat</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">3</th>
                            <td colspan="2" class="col-6">Larry the Bird</td>
                            <td class="col-3">@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">4</th>
                            <td class="col-3">Martin</td>
                            <td class="col-3">Williams</td>
                            <td class="col-3">@Marty</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">5</th>
                            <td colspan="2" class="col-3">Sam</td>
                            <td colspan="2" class="col-3">Pascal</td>
                            <td class="col-3">@sam</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">6</th>
                            <td class="col-3">John</td>
                            <td class="col-3">Green</td>
                            <td class="col-3">@john</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">7</th>
                            <td colspan="2" class="col-3">David</td>
                            <td colspan="2" class="col-3">Bowie</td>
                            <td class="col-3">@david</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">8</th>
                            <td class="col-3">Pedro</td>
                            <td class="col-3">Rodriguez</td>
                            <td class="col-3">@rod</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">5</th>
                            <td colspan="2" class="col-3">Sam</td>
                            <td colspan="2" class="col-3">Pascal</td>
                            <td class="col-3">@sam</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">10</th>
                            <td class="col-3">Jacob</td>
                            <td class="col-3">Thornton</td>
                            <td class="col-3">@fat</td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-3">11</th>
                            <td colspan="2" class="col-6">Larry the Bird</td>
                            <td class="col-3">@twitter</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="card-body p-4">
    <div class="over overflow-x-auto">
        <table id="example">
            <thead>
                <tr>

                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
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
