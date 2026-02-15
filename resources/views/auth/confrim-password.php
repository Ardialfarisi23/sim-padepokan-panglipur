@extends('layouts.app')


@section('content')
<section style="min-height:80vh;display:flex;align-items:center;justify-content:center;">
    <div style="background:white;padding:40px;border-radius:16px;max-width:480px;width:100%;text-align:center;">
       
        <h2 style="color:#dc2626;">Login Gagal ❌</h2>


        <p style="margin-top:10px;">
            Email atau password salah.  
            Silakan coba kembali.
        </p>


        <a href="{{ route('login') }}"
           style="margin-top:20px;display:inline-block;padding:10px 24px;background:#dc2626;color:white;border-radius:8px;text-decoration:none;">
            Kembali ke Login
        </a>


    </div>
</section>
@endsection
