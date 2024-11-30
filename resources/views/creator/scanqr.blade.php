@extends('layouts.appCreator')

@push('css')
    <link rel="stylesheet" href="{{ asset('components/css/scanQr.css') }}">
    <style>
        .container-view {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .box-result {
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            max-width: 500px;
            text-align: center;
        }

        #qr-reader {
            border: 2px dashed #6c757d;
            border-radius: 8px;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('title', 'Profile Creator - Tiket Mudah')

@section('content')
    <div class="container-view">
        <div class="box-result">
            <h2 class="mb-3">Scan QR Code</h2>
            <div id="qr-reader" class="qr-reader mb-3"></div>
            <div class="result">
                <form action="{{ route('postScanQr') }}" method="POST" id="scan-form">
                    @csrf
                    <input type="text" id="kode_result" name="kode_result" class="text-center" readonly>
                    <button type="submit" class="btn btn-primary hidden">Submit</button>
                </form>                

                @if (session('scan-berhasil'))
                    <div class="bg-green-500 text-center mt-3">
                        <p>{{ session('scan-berhasil') }}</p>
                    </div>
                @endif
                @if (session('scan-warning'))
                    <div class="bg-yellow-500 text-center mt-3">
                        <p>{{ session('scan-warning') }}</p>
                    </div>
                @endif
                @if (session('scan-gagal'))
                    <div class="bg-red-500 text-center mt-3">
                        <p>{{ session('scan-gagal') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('components/js/scanQr.js') }}"></script>
<script>
    function docReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function() {
        var lastResult; // Variable to store the last scan result
        let input = document.getElementById('kode_result'); // Input to store the scan result
        let form = document.getElementById('scan-form'); // Form to submit the scan result

        function onScanSuccess(decodedText, decodedResult) {
            // Check if the scan result has already been processed
            if (decodedText !== lastResult) {
                lastResult = decodedText; // Store the scan result as lastResult

                console.log(`Scan result: ${decodedText}`, decodedResult); // Log the scan result for debugging

                // Set the value of the hidden input with the scan result
                input.value = decodedText;

                // Automatically submit the form
                form.submit();
            }
        }

        // Initialize QR Code scanner
        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 10, // Frames per second
            qrbox: 250 // Scanning area size
        });

        // Render the scanner and set the callback function
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
@endpush