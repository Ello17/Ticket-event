@extends('layouts.appCreator')

@push('css')
@endpush

@section('title', 'Kelola Tiket - Tiket Mudah')

@section('content')
    <div class="content  p-8">
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
                                <th class="py-2 px-4 border">Event Name</th>
                                <th class="py-2 px-4 border">Kategori Tiket</th>
                                <th class="py-2 px-4 border">Price</th>
                                <th class="py-2 px-4 border">Offline Event Link</th>
                                <th class="py-2 px-4 border">Number of Tickets</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($events as $item)
                                <tr class="border-b" id="row-{{ $item->tiket->first()->id ?? '' }}">
                                    <td class="p-2">
                                        <img src="{{ asset($item->cover_event) }}" alt="Poster Event" class="w-20 h-auto">
                                    </td>
                                    <td class="p-2">{{ $item->nama_event }}</td>

                                    <td class="border p-4">
                                        @if ($item->tiket && $item->tiket->isNotEmpty())
                                            {{ $item->tiket->first()->kategori_tiket }}
                                        @else
                                            No categories
                                        @endif
                                    </td>
                                    <td class="border p-4">
                                        @if ($item->tiket && $item->tiket->isNotEmpty())
                                            {{ $item->tiket->first()->harga_tiket }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="border p-4">
                                        @if ($item->tiket && $item->tiket->isNotEmpty())
                                            {{ $item->tiket->first()->link_tiket }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="border p-4">
                                        @if ($item->tiket && $item->tiket->isNotEmpty())
                                            {{ $item->tiket->first()->jumlah_tiket }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="p-2">
                                        <div class="flex text-center justify-center space-x-2">
                                            @if ($item->tiket->isEmpty())
                                                <a href="{{ route('tambahtiket', ['event_id' => $item->id]) }}"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm">Add Ticket</a>
                                            @else
                                                <a href="{{ route('editTiket', $item->tiket->first()->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                                <form action="{{ route('hapusTiket', $item->tiket->first()->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
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
        $(document).ready(function() {
            $('#example').DataTable();

            $(document).on('click', '.hapus-tiket', function() {
                const tiketId = $(this).data('id');

                if (confirm('Are you sure you want to delete this ticket?')) {
                    $.ajax({
                        url: `/hapus-tiket/${tiketId}`, 
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}" 
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message); 
                                $(`#row-${tiketId}`).remove();
                            } else {
                                alert(response
                                .message); 
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); 
                            alert(
                            'Failed to delete ticket. Try again!'); 
                        }
                    });
                }
            });
        });
    </script>
@endpush
