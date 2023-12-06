@extends('pages.app')
@section('content')
<div class="container discovery">
    <div class="row">
        <div class="col-1">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown ">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Urutkan
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 mt-4">
            @include('layouts.card')
        </div>
        <div class="col-3 mt-4">
            @include('layouts.card')
        </div>
        <div class="col-3 mt-4">
            @include('layouts.card')
        </div>
        <div class="col-3 mt-4">
            @include('layouts.card')
        </div>
        <div class="col-3 mt-4">
            @include('layouts.card')
        </div>
        <div class="col-3 mt-4">
            @include('layouts.card')
        </div>
    </div>
</div>
@endsection