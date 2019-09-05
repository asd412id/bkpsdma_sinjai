<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Pegawai;

use Validator;
use Auth;
use Str;
use Spreadsheet;

class MainController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


  public function index()
  {
    $data = [
      'title'=>'Selamat Datang - BKPSDMA'
    ];
    return view('index',$data);
  }

  public function login()
  {
    $data = [
      'title'=>'Login - BKPSDMA'
    ];

    return view('login',$data);
  }

  public function loginProcess(Request $r)
  {
    $roles = [
      'username' => 'required',
      'password' => 'required'
    ];

    $messages = [
      'username.required' => 'Username tidak boleh kosong!',
      'password.required' => 'Password tidak boleh kosong!'
    ];

    Validator::make($r->all(),$roles,$messages)->validate();

    if (Auth::attempt([
      'username'=>$r->username,
      'password'=>$r->password,
    ],($r->remember?true:false))) {
      return redirect()->back();
    }

    return redirect()->back()->withErrors(['Username atau password tidak sesuai!'])->withInput($r->only('username','remember'));
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->back();
  }

  public function profile()
  {
    $data = [
      'title'=>'Data Profil - BKPSDMA',
      'data'=>auth()->user()
    ];

    return view('profile',$data);
  }

  public function profileUpdate(Request $r)
  {
    $roles = [
      'nama' => 'required',
      'username' => 'required',
      'old_password' => 'required'
    ];

    $messages = [
      'nama.required' => 'Nama tidak boleh kosong!',
      'username.required' => 'Username tidak boleh kosong!',
      'old_password.required' => 'Password tidak boleh kosong!'
    ];

    Validator::make($r->all(),$roles,$messages)->validate();

    $cek = auth()->validate(['id'=>auth()->user()->id,'password'=>$r->old_password]);


    if ($cek) {
      $user = User::where('id',auth()->user()->id)
      ->first();
      $user->nama = $r->nama;
      $user->username = $r->username;
      if ($r->new_password!='') {
        $user->password = bcrypt($r->new_password);
      }
      $user->save();
      return redirect()->back()->withMessage('Profil berhasil diubah');
    }

    return redirect()->back()->withErrors(['Password tidak sesuai!']);
  }

  public function search(Request $r)
  {
    Validator::make($r->all(),[
      'q' => 'required|numeric|digits:18'
    ],[
      'q.required' => 'Format NIP yang dimasukkan tidak benar!',
      'q.numeric' => 'Format NIP yang dimasukkan tidak benar!',
      'q.digits' => 'Jumlah NIP yang dimasukkan harus 18 angka!'
    ])->validate();

    $pegawai = Pegawai::where('nip_baru',$r->q)
    ->limit(20)
    ->first();

    return redirect()->route('search.detail',['nip'=>$r->q]);
  }

  public function detail($nip)
  {
    $pegawai = Pegawai::where('nip_baru',$nip)->first();

    $title = $pegawai?'Biodata Pegawai Negeri Sipil: '.$pegawai->nama.' - BKPSDMA':'Biodata Pegawai tidak Ditemukan! - BKPSDMA';

    $data = [
      'title' => $title,
      'data' => $pegawai
    ];

    return view('search-detail',$data);
  }

}
