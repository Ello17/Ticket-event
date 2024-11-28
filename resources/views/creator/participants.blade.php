@extends('layouts.appCreator')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
@endpush

@section('title', 'Profile Creator - Tiket Mudah')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Daftar Participants</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-300 shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">No</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Nama Customer</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Nama Event</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Kode Tiket</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Hadir</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Waktu Scan</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($participants as $participant)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">{{ $participant->user->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">{{ $participant->event->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">{{ $participant->kode_result }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                        <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 ">
                            {{ $participant->status }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">{{ $participant->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
