@extends('layouts.appCreator')

@push('css')
@endpush

@section('title', 'Kelola Tiket - Tiket Mudah')

@section('content')
<div class="content ml-64 p-8">
    <div class="card bg-white shadow-lg rounded-lg">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Tabel List Tiket</h5>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200" id="example">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            <th class="py-2 px-4 border">Poster</th>
                            <th class="py-2 px-4 border">Nama Event</th>
                            <th class="py-2 px-4 border">Kategori Tiket</th>
                            <th class="py-2 px-4 border">Harga</th>
                            <th class="py-2 px-4 border">Jumlah Tiket</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($events as $item)
                        <tr class="border-b" id="row-{{ $item->tikets->first()->id ?? '' }}">
                            <td class="p-2">
                                <img src="{{ asset($item->cover_event) }}" alt="Poster Event" class="w-20 h-auto">
                            </td>
                            <td class="p-2">{{ $item->nama_event }}</td>

                            <td class="border p-4">
                                @if ($item->tikets && $item->tikets->isNotEmpty())
                                    {{ $item->tikets->first()->kategori_tiket }}
                                @else
                                    Tidak ada kategori
                                @endif
                            </td>
                            <td class="border p-4">
                                @if ($item->tikets && $item->tikets->isNotEmpty())
                                    {{ $item->tikets->first()->harga_tiket }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border p-4">
                                @if ($item->tikets && $item->tikets->isNotEmpty())
                                    {{ $item->tikets->first()->jumlah_tiket }}
                                @else
                                    N/A
                                @endif
                            </td>

                            <td class="p-2">
                                @if ($item->tikets->isEmpty())
                                    <a href="{{ route('tambahtiket', ['event_id' => $item->id]) }}" class="text-blue-500 hover:underline">
                                        Tambah Tiket
                                    </a>
                                @else
                                    <a href="{{ route('editTiket', $item->id) }}" class="text-green-500 hover:underline">
                                        Edit Tiket
                                    </a>

                                    <form action="{{ route('hapusTiket', $item->tikets->first()->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:underline"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                            Hapus Tiket
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>

<script>
   $(document).ready(function () {
    // Inisialisasi DataTable
    $('#example').DataTable();

    // Menggunakan event delegation untuk hapus tiket
    $(document).on('click', '.hapus-tiket', function () {
        const tiketId = $(this).data('id'); // Ambil ID tiket dari atribut data-id

        if (confirm('Apakah Anda yakin ingin menghapus tiket ini?')) {
            $.ajax({
                url: `/hapus-tiket/${tiketId}`, // Route hapus tiket
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}" // CSRF token untuk keamanan
                },
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message); // Tampilkan pesan sukses
                        $(`#row-${tiketId}`).remove(); // Hapus baris tiket dari tabel
                    } else {
                        alert(response.message); // Pesan error jika tiket tidak ditemukan
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText); // Debug jika terjadi error
                    alert('Gagal menghapus tiket. Coba lagi!'); // Pesan error jika gagal
                }
            });
        }
    });
});

</script>
@endpush
