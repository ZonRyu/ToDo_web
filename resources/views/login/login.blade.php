@extends('layouts.main')
@section('container')
    <div class="container">
        <div class="d-flex justify-content-center top-card">
            <div class="card">
                <div class="card-body">
                    <img src="assets/img/osu.png" class="card-img-top">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input name="email" type="text" class="form-control" id="email" placeholder="Email">
                            @error('email')
                                <div class="center-text">
                                    {{ $message }}    
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                            <input type="checkbox" onclick="myFunction()">Show Password
                            <script>
                                function myFunction() {
                                    var x = document.getElementById("password");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>
                            @error('password')
                                <div class="center-text">
                                    {{ $message }}    
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn">Submit</button>
                        <small class="d-block kata">Belum Punya Akun? <a href="/register" class="txt">Register</a></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection