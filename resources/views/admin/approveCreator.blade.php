@extends('layouts.appAdmin')
@section('title', 'Creator Account Approval - Tiket Mudah')
@section('content')
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 border-b">
            <h5 class="text-lg font-semibold">Creator Account Approval List Table</h5>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <form method="GET" action="{{ route('pending.users') }}" class="mb-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by username or email"
                        class="border rounded px-2 py-1">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">
                        <i class="ri-search-2-line"></i>
                    </button>
                </form>

                @if ($pendingUsers->isEmpty())
                    <p class="text-center text-gray-500">No creators need to be approved.</p>
                @else
                    <table id="approvalTable" class="min-w-full bg-white table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-center">No</th>
                                <th class="border px-4 py-2 text-center">Name</th>
                                <th class="border px-4 py-2 text-center">Email</th>
                                <th class="border px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingUsers as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2 text-center">{{ $loop->iteration + ($pendingUsers->currentPage() - 1) * $pendingUsers->perPage() }}</td>
                                    <td class="border px-4 py-2">{{ $user->username }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <form action="{{ route('approve.user', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm">
                                                <i class="ri-check-line"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('rejectUser', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $pendingUsers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- DataTables Scripts --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#approvalTable').DataTable({
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
                "pageLength": 10, // Number of entries per page
            });
        });
    </script>
@endsection
