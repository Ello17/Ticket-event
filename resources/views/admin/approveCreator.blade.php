@extends('layouts.app')

@section('content')
<h1>Daftar Pengguna yang Menunggu Persetujuan</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendingUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('approve.user', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Setujui</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
