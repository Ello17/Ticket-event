@extends('layouts.appCreator')

@push('css')
<link rel="stylesheet" href="{{ asset('components/css/scanQr.css') }}">
@endpush

@section('title', 'Profile Creator - Tiket Mudah')

@section('content')
<div class="container-view">
    <div class="box-result">
        <div id="qr-reader" class="qr-reader"></div>
        <br>
        <div class="result">
            <p id="qr-reader-results">Scan result :</p>
            <form action="{{ route('postScanQr') }}" method="POST" id="formqr">
                @csrf
                <input type="text" id="input" name="kode_tiket">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>                      
        </div>
    </div>

    {{-- Tampilkan pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection

@push('js')
<script src="{{ asset('components/js/scanQr.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let resultElement = document.getElementById('qr-reader-results');
        let inputElement = document.getElementById('input');
        let formElement = document.getElementById('formqr');

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== inputElement.value) {
                inputElement.value = decodedText;  // Masukkan hasil scan ke input
                resultElement.textContent = `Scan result: ${decodedText}`; // Tampilkan hasil scan di halaman
                formElement.submit();  // Submit otomatis form
            }
        }

        const html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>

@endpush
