@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>List domains</h1>
            <domains-list :domains="{{ $domain }}"></domains-list>
            <domain-inventions :domains="{{ $domain }}"></domain-inventions>
        </div>
    </section>
@endsection
