<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Transaksi</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <script type="text/javascript">
        window.snap.pay("{{ $snap_token }}", {
            onSuccess: function(result){
                window.location.href = "{{ route('history') }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('history') }}";
            },
            onError: function(result){
                alert('Pembayaran gagal. Silakan coba lagi.');
            },
        });
    </script>
</body>
</html>
