@extends('layouts.appAdmin')
@section('title', 'Kelola Customer - Tiket Mudah')
@section('content')
    <h2 class="text-2xl font-bold mb-4">Customer Manage</h2>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, magnam amet magni sapiente, quo alias repellendus,
        maiores esse eius ratione dolorum aspernatur voluptatibus veritatis molestias id. Doloribus eos cupiditate tempore.
    </p>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 border-b">
            <h5 class="text-lg font-semibold">Tabel List Event</h5>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
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
                                    <a href="{{ route('hapusCustomer', $user->id) }}"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                                        onclick="return confirm('Are you sure?')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
