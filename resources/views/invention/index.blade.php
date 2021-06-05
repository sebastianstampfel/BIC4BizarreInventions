@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>All inventions</h1>
            <inventions-list :inventions="{{ $invention }}"></inventions-list>
            <!-- {{ $invention }} -->
        </div>
    </section>
@endsection
