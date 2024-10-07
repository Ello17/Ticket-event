@extends('layouts.appAdmin')
@push('css')
@endpush
@section('title', 'Home Admin - Tiket Mudah')
@section('content')
<div class="content ml-64 p-8">
    <div class="card bg-white shadow-lg rounded-lg">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Tabel List Event</h5>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">No</th>
                            <th class="border px-4 py-2 text-left">Username</th>
                            <th class="border px-4 py-2 text-left">Email</th>
                            <th class="border px-4 py-2 text-left">Role</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $user->username }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">{{ $user->role }}</td>
                                <td class="border px-4 py-2">
                                    <a href="" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                                        onclick="return confirm('Are you sure?')">Hapus</a>
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
