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
<p id="qr-reader-results">Scan result :</p>
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
<script src="{{asset('components/js/scanQr.js')}}"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }
let result = document.getElementById('qr-reader-results');
docReady(function () {
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;
    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                result.innerHTML = (`Scan result : ${decodedText}`);
            }
        }


        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
@endpush
