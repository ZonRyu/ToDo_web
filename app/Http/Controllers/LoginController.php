<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    public function authanticate(Request $request)
    {

        $login = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($login)) {
            $request->session()->regenerate();
            Alert::success('Success','Berhasil login');
            return redirect()->intended('/dashboard');
        }

        Alert::error('error','Login gagal, coba lagi!');
        return back();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::toast('Anda telah logout!', 'warning');
        return redirect('/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.create');
    }

    public function datagaming()
    {

        $todos = Login::where('user_id', auth()->user()->id)->get(); //menampilkan data berdasarkan user id

        return view('data.data', compact('todos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tittle' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);

        Login::create([

            /*
                yang ' ' = nama column
                yang $request-> = value name di input
                kenapa kirim 5 data padahal di input ada 3 inputan? kalau dicek di table
                todos itu kan ada 6 column yang harus diisi, salah satunya column done_date yang 
                nullable, kalau nullable itu gausah diisi juga gapapa jadi ga diisi dulu
                user_id ngambil id dari fitur auth (history login), supaya tau itu todo
                punya siapa
                column status kan boolean, jadi kalo status si todo belum dikerjain = 0
            */

            'tittle' => $request->tittle,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        Alert::success('success','Data berhasil ditambahkan!');
        return redirect('/data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* 
            parameter $id mengambil data path dinamis {$id}
            ambil satu baris data yang memiliki value column id sama
            dengan data path dinamis id yang dikirim ke route
        */
        $todo = Login::where('id', $id)->first();
        /* 
            kemudian arahkan/tampilkan file view yang bernama edit.blade.php
            dan kirim dari $todo ke file edit tersebut dengan bantuan compact
        */
        return view('data.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi
        $request->validate([
            'tittle' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
        /* 
            cari baris daya yang punya value column id sama dengan id yang dikirim ke
            route
        */
        Login::where('id', $id)->update([
            'tittle' => $request->tittle,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);
        /* 
            kalau berhasil, arahkan ke halaman data dengan pemberitahuan berhasil
        */
        Alert::success('success','Berhasil mengubah data!');
        return redirect('/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* 
            cari data yang mau dihapus, kalo ketemu langsung hapus datanya
        */
        Login::where('id', $id)->delete();
        /* 
            kalau berhasil arahin balik ke halaman data dengan pemberitahuan
        */
        Alert::warning('success','Berhasil menghapus data!');
        return redirect('/data');
    }

    public function updateToCompleted(Request $request, $id)
    {
        /* 
            cari data yang akan diupdate
            baru setelahnya data diupdate ke database melalui model
            status tipenya boolean (0/1) : 0 (on-process) & 1 (completed)
            carbon : package laravel yang mengelola segala hal yang berhubungan dengan date
            now() : mengambil tanggal hari ini
        */
        Login::where('id', '=', $id)->update([
            'status' => 1,
            'done_time' => \Carbon\Carbon::now(),
        ]);
        /* 
            jika berhasil, akan dibalikkan ke halaman awal (halaman tempat button
            completed berada). kembalikan dengan pemberitahuan
        */
        Alert::success('success','Berhasil mengubah data !');
        return redirect()->back();
    }
}
