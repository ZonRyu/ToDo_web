@extends('layouts.main')
@section('container')
<table class="table">
    <tr>
        <td scope="col">No</td>
        <td scope="col">Judul</td>
        <td scope="col">Isi</td>
        <td scope="col">Tanggal</td>
        <td scope="col">Status</td>
        <td scope="col">Aksi</td>
    </tr>
    @php
    $no = 1;
    @endphp
    @foreach ($todos as $todo)
    <tr>
        {{-- tiap di looping, $no bakal ditambah 1 --}}
        <td class="no">{{ $no++ }}</td>
        <td class="title"><p class="text-truncate">{{ $todo['tittle'] }}</p> </td>
        <td class="isi"><p class="text-truncate">{{ $todo['description'] }}</p></td>
        {{-- Carbon : package date pada laravel, nantinya si date yang 2022-11-22 formatnya menjadi 22 November,
                2022 --}}
        <td class="date">{{ \Carbon\Carbon::parse($todo['date'])->format('j F, Y') }}</td>
        {{-- Konsep tenrary, if statusnya 1 nampilin teks complated kalo 0 nampilin teks on-process,
                status tuh boolean kan? cuman antara 1 atau 0--}}
        <td class="status">{{ $todo['status'] ? 'Completed' : 'On-Process' }}</td>
        <td>
        <div class="d-flex">
            {{-- 
                    karena path {id} merupakan path dinamis, jadi kita harus isi
                    path dinamis tersebut. karena kita mengisinya dengan data dinamis
                    /data dari database jadi buat isi nya pake kurung kurawal dua kali
                --}}
            <a class="edit" href="/edit/{{$todo['id']}}">Edit</a>
            {{-- 
                fitur delete harus menggunakan form lagi. tombol hapusnya
                disimpan di tag button
            --}}
            <form action="/destroy/{{$todo['id']}}" method="POST">
                @csrf
                {{-- 
                    menimpa method="POST", karena di route nya menggunakan
                    method DELETE
                --}}
                @method('DELETE')
                <button class="hapus" type="submit">Hapus</button>
            </form>
            @if ($todo['status'] == 0)
                <form action="/completed/{{$todo['id']}}" method="POST">
                @csrf
                @method('PATCH')
                <button class="done" type="submit">Done</button>
                </form>
            @endif 
        </div>
        </td>
    </tr>
    @endforeach
</table>
@endsection
