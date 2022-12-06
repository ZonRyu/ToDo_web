@extends('layouts.main')
@section('container')
    <div class="container">
        <div class="d-flex justify-content-center top-card-dash">
            <div class="card">
                <div class="card-body">
                    <h3>Selamat Datang di Dashboard!</h3>
                    <p>Username : {{ auth()->user()->username }}</p>
                    <p>Email : {{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection