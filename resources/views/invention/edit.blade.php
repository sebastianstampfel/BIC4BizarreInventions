@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>Edit invention</h1>
            <invention-form :is-editable="true" :current-invention="{{ $invention }}"></invention-form>
        </div>
    </section>
@endsection
