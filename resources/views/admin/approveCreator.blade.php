@extends('layouts.appAdmin')

@push('css')
@endpush

@section('title', 'Home Admin - Tiket Mudah')

@section('content')
<div class="ml-64 p-8">
    <div class="bg-white shadow-lg rounded-lg">
        <div class="p-4 border-b border-gray-200">
            <h5 class="text-lg font-semibold">Tabel List Persetujuan</h5>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-200 px-4 py-2">Nama</th>
                            <th class="border border-gray-200 px-4 py-2">Email</th>
                            <th class="border border-gray-200 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingUsers as $user)
                            <tr class="bg-white hover:bg-gray-100">
                                <td class="border border-gray-200 px-4 py-2">{{ $user->username }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-200 px-4 py-2">
                                    <form action="{{ route('approve.user', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm">
                                            Setujui
                                        </button>
                                    </form>
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
        $('#example').DataTable();
    });
</script>
@endpush
