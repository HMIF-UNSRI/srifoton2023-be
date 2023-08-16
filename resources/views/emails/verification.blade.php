@extends('emails.layout')

@push('title')
    Verifikasi Email
@endpush

@push('greet')
    Halo {{ $user->name }}
@endpush

@push('command')
    Klik tombol dibawah untuk melakukan verifikasi email
@endpush

@push('button-url')
    {{ $verificationUrl }}
@endpush

@push('button-name')
    Verifikasi Email
@endpush

@push('paragraph')
    Jika anda merasa tidak melakukan permintaan ini, abaikan pesan ini. Ini
    adalah email yang dibuat secara otomatis, tolong jangan balas email ini.
@endpush

@push('button-alias')
    Verifikasi Email
@endpush

@push('link-href')
    {{ $verificationUrl }}
@endpush

@push('link-text')
    {{ $verificationUrl }}
@endpush
