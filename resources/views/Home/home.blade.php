@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            {{__('messages.welcome') }}
            {{Auth::user()->service->name_en}}
        </h1>
    </div>
@include('Home.partials.register-stats')
@endsection
