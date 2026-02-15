@extends('layouts.app')


@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow text-center">
        <h1 class="text-2xl font-bold text-green-600 mb-4">
            Login Berhasil 🎉
        </h1>


        <p class="mb-6">Selamat datang, kamu berhasil login.</p>


        <a href="{{ url('/dashboard') }}"
           class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Lanjut ke Dashboard
        </a>
    </div>
</div>
@endsection
