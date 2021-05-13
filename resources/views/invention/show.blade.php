@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>Show invention</h1>
            <invention :invention="{{ $invention }}"></invention>
        </div>
    </section>
@endsection
