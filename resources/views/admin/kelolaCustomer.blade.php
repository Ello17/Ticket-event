@extends('layouts.appAdmin')
@section('title', 'Kelola Customer - Tiket Mudah')
@section('content')
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Customer List Table</h5>
        </div>
        <div class="card-body p-4">
            {{-- Form Search --}}
            {{-- <form method="GET" action="{{ route('kelolaCustomer') }}" class="mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by username or email" class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"><i class="ri-search-2-line"></i></button>
            </form> --}}

            <div class="overflow-x-auto">
                <table id="customerTable" class="min-w-full bg-white table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Username</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Role</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border p-2">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td class="border p-2">{{ $user->username }}</td>
                                <td class="border p-2">{{ $user->email }}</td>
                                <td class="border p-2">{{ $user->role }}</td>
                                <td class="border p-2">
                                    <div class="flex text-center space-x-2">
                                        <a href="{{ route('hapusCustomer', $user->id) }}"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                            onclick="return confirm('Are you sure?')"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination (tidak diperlukan jika DataTables diaktifkan) --}}
            {{-- <div class="mt-4">
                {{ $users->appends(['search' => request('search')])->links() }}
            </div> --}}
        </div>
    </div>

    {{-- DataTables Scripts --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
    $('#customerTable').DataTable({
        "language": {
            "search": "Search:",
            "lengthMenu": "Show _MENU_ entries per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No entries available",
            "zeroRecords": "No matching records found",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "pageLength": 10,
    });
});
    </script>
      <style>
        #customerTable_filter{
            margin-bottom: 10px !important;
        }
    </style>
@endsection
