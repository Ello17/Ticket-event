@extends('layouts.appAdmin')
@section('title', 'Home Admin - Tiket Mudah')
@section('content')
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <h5 class="text-lg font-semibold">Tabel List Persetujuan</h5>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <!-- Search Form -->
                <form method="GET" action="{{ route('pending.users') }}" class="mb-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by username or email" class="border rounded px-2 py-1">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"><i
                            class="ri-search-2-line"></i></button>
                </form>
                @if ($pendingUsers->isEmpty())
                    <p class="text-center text-gray-500">Tidak ada creator yang perlu disetujui.</p>
                @else
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
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm">
                                                Setujui
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Paginasi -->
                    <div class="mt-4">
                        {{ $pendingUsers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
