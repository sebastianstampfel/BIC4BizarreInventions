@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1>Edit domain</h1>
            <domain-form :is-editable="true" :current-domain="{{ $domain }}"></invention-form>
        </div>
    </section>
@endsection
