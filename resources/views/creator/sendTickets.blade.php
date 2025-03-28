@extends('layouts.appCreator')
@section('title', 'Home Creator - Tiket Mudah')

@section('content')
    <div class="content p-8">
        <div class="card bg-white shadow-lg rounded-lg">
            <div class="card-header p-4 border-b">
                <h5 class="text-lg font-semibold text-gray-800">Send Ticket Online</h5>
            </div>
            <div class="card-body p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg" id="example">
                        <thead>
                            <tr class="bg-blue-500 text-white text-left">
                                <th class="py-3 px-4 border-b">Event Name</th>
                                <th class="py-3 px-4 border-b">Full name</th>
                                <th class="py-3 px-4 border-b">Phone number</th>
                                <th class="py-3 px-4 border-b">Ticket Category</th>
                                <th class="py-3 px-4 border-b">Number of Tickets</th>
                                <th class="py-3 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($transaksi as $item)
                                <tr class="hover:bg-gray-100 border-b">
                                    <td class="py-3 px-4">{{ $item->event->nama_event }}</td>
                                    <td class="py-3 px-4">{{ $item->nama_lengkap }}</td>
                                    <td class="py-3 px-4">{{ $item->no_telepon }}</td>
                                    <td class="py-3 px-4">{{ $item->tiket->kategori_tiket }}</td>
                                    <td class="py-3 px-4">{{ $item->tiket_dibeli }}</td>
                                    <td class="py-3 px-4">
                                        <a href="https://wa.me/{{ '62' . preg_replace('/[^0-9]/', '', $item->no_telepon) }}?text={{ urlencode('Halo, ' . $item->nama_lengkap . ', Thank you for purchasing event tickets ' . $item->event->nama_event . '.') }}"
                                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm" target="_blank">
                                            Send Tickets
                                         </a>

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
