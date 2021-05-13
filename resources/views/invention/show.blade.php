@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <invention :invention="{{ $invention }}"></invention>
        </div>
    </section>
@endsection
