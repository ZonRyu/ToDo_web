@extends('layouts.main')
@section('container')
    <div class="container">
        <div class="d-flex justify-content-center top-card">
            <div class="card">
                <div class="card-body">
                    <form action="/update/{{$todo['id']}}" method="POST" style="max-width: 500px; margin: auto;">
                        @csrf
                        {{-- 
                            karena attribute method pada tag form cuman bisa GET/POST sedangkan buat
                            update data itu pake method PATCH, jadi method="POST" di form di timpa sama
                            method PATCH ini
                         --}}
                        @method('PATCH')
                        <div class="mb-3">
                            {{-- 
                                attribute value berfungsi untuk menampilkan data di inputnya. data
                                yang ditampilin merupakan data yang diambil di controller dan dikirim
                                lewat compact tadi 
                            --}}
                            <input name="tittle" type="string" value="{{$todo['tittle']}}" class="form-control" placeholder="Tittle">
                            @error('tittle')
                            <div class="center-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input name="date" type="date" value="{{$todo['date']}}" class="form-control">
                            @error('date')
                            <div class="center-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- 
                                kenapa textarea gapunya attribute value? karena textarea bukan
                                termasuk tag input/select, jadi buat nampilinnya langsung tanpa attribute
                                value (sebelum penutup tag textarea)
                            --}}
                            <textarea name="description" cols="30" rows="10" placeholder="Description">{{$todo['description']}}</textarea>
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