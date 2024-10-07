<!-- Toast Notification Berhasil -->
@if (session('pesan-berhasil'))
    <div class="toast fixed bottom-6 right-6 bg-white rounded-lg shadow-2xl py-3 pl-3 pr-5 pointer-events-none">
        <div class="flex items-center">
            <div class="flex text-green-500">
                <i class="ri-checkbox-circle-line"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-black">Berhasil</p>
                <p class="mt-1 text-sm text-gray-600">{{ session('pesan-berhasil') }}</p>
            </div>
        </div>
    </div>
@endif
<!-- Toast Notification Kesalahan -->
@if (session('pesan-gagal'))
    <div class="toast fixed bottom-6 right-6 bg-white rounded-lg shadow-2xl py-3 pl-3 pr-5 pointer-events-none">
        <div class="flex items-center">
            <div class="flex text-red-500">
                <i class="ri-close-circle-line"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-black">Gagal</p>
                <p class="mt-1 text-sm text-gray-600">{{ session('pesan-gagal') }}</p>
            </div>
        </div>
    </div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Hide toast messages after 5 seconds
        $('.toast').delay(5000).fadeOut();
    });
</script>
