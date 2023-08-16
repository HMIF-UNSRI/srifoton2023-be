@extends('emails.layout')

@push('title')
    Undangan Grup Whatsapp
@endpush

@push('greet')
    Halo {{ $name }} dari tim {{ $team_name }}
@endpush

@push('command')
    Klik tombol dibawah untuk masuk ke grup whatsapp {{ $competition }} Srifoton 2023
@endpush

@push('button-url')
    {{ $link }}
@endpush

@push('button-name')
    Masuk Grup Whatsapp
@endpush

@push('paragraph')
    Pembayaran anda telah diverifikasi. Silahkan masuk ke dalam grup untuk informasi selanjutnya. Jika ada kendala silahkan hubungi contact person.
@endpush

@push('button-alias')
    Masuk Grup Whatsapp
@endpush

@push('link-href')
    {{ $link }}
@endpush

@push('link-text')
    {{ $link }}
@endpush
