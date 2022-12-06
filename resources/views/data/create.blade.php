@extends('layouts.main')
@section('container')
    <div class="container">
        <div class="d-flex justify-content-center top-card">
            <div class="card">
                <div class="card-body">
                    <form action="/data" method="POST" style="max-width: 500px; margin: auto;">
                        @csrf
                        <div class="mb-3">
                            <input name="tittle" type="string" class="form-control" placeholder="Tittle">
                            @error('tittle')
                            <div class="center-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input name="date" type="date" class="form-control">
                            @error('date')
                            <div class="center-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="description" cols="30" rows="10" placeholder="Description"></textarea>
                            @error('description')
                            <div class="center-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection