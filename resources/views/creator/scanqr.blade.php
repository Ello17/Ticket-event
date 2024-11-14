@extends('layouts.appCreator')

@push('css')
<link rel="stylesheet" href="{{asset('components/css/scanQr.css')}}">
@endpush

@section('title', 'Profile Creator - Tiket Mudah')
@section('content')
<div class="container-view">
    <div class="box-result">
        <div id="qr-reader" class="qr-reader"></div>
        <br>
        <div class="result">
            <form action="{{ route('postScanQr') }}" method="POST" id="scan-form">
                @csrf
                <p id="qr-reader-results">Scan result :</p>
                <input type="text" id="input" name="kode_result" readonly>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
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

<script src="{{asset('components/js/scanQr.js')}}"></script>
<script>
    function docReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var lastResult;
        let result = document.getElementById('qr-reader-results');
        let input = document.getElementById('input');
        let form = document.getElementById('scan-form');

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                lastResult = decodedText;
                console.log(`Scan result: ${decodedText}`, decodedResult);
                
                // Set the input value to the scan result
                input.value = decodedText;
                result.innerHTML = `Scan result : ${decodedText}`;
                
                // Automatically submit the form
                form.submit();
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
@endpush
