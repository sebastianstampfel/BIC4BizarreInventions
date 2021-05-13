@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>List invention</h1>
            <h2>KLJWkljwahdl</h2>
            <inventions-list :inventions="{{ $invention }}"></inventions-list>
            <!-- {{ $invention }} -->
        </div>
    </section>
@endsection
