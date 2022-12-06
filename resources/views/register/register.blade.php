@extends('layouts.main')
@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="container">
                <div class="d-flex justify-content-center top-card">
                    <div class="card">
                        <div class="card-body">
                            <img src="assets/img/osu.png" class="card-img-top">
                            <form action="/register" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input name="username" type="string" class="form-control" id="username" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn">Submit</button>
                                <small class="d-block kata">Siap kembali? <a href="/?" class="txt">Login</a></small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection