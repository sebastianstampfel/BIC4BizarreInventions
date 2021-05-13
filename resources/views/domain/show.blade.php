@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>Show domain</h1>
            <domain :domain="{{ $domain }}"></domain>
            <!-- <domain-inventions :domain="{{ $domain }}"></domain-inventions> -->
        </div>
    </section>
@endsection
