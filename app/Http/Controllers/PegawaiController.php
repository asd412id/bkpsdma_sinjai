<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Pegawai;
use DataTables;
use Str;
use Validator;
use Storage;
use PDF;

class PegawaiController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index()
  {

    if (request()->ajax()) {
      $data = Pegawai::latest()->get();
      return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('jk',function($row){
        $jk = $row->jenis_kelamin=='1'?'Pria':'Wanita';
        return $jk;
      })
      ->addColumn('action', function($row){

        $btn = '<a href="'.route('pegawai.show',['uuid'=>$row->uuid]).'" class="btn-link text-success" title="Lihat detail"><i class="fa fa-fw fa-info-circle"></i></a>';

        $btn = $btn.' <a href="'.route('pegawai.edit',['uuid'=>$row->uuid]).'" class="edit btn-link text-primary" title="Ubah data"><i class="fa fa-fw fa-edit"></i></a>';

        $btn = $btn.' <a href="'.route('pegawai.destroy',['uuid'=>$row->uuid]).'" class="btn-link text-danger hapus" title="Hapus data"><i class="fa fa-fw fa-trash"></i></a>';

        return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    $data = [
      'title'=>'Data Pegawai  - BKPSDMA'
    ];

    return view('pegawai.index',$data);

  }

  public function create()
  {
    $data = [
      'title'=>'Tambah Data Pegawai  - BKPSDMA'
    ];

    return view('pegawai.create',$data);
  }

  public function store(Request $r)
  {

    $role = [
      'nip_baru'=>'required|numeric|digits:18|unique:pegawai,nip_baru,'.$r->uuid.',uuid',
      'nama'=>'required',
      'instansi'=>'required',
      'jenis_kelamin'=>'required',
      'golongan'=>'required'
    ];

    $msg = [
      'nip_baru.required'=>'NIP tidak boleh kosong!',
      'nip_baru.unique'=>'NIP telah digunakan!',
      'nip_baru.numeric'=>'NIP harus berupa angka tanpa spasi!',
      'nip_baru.digits'=>'NIP harus berjumlah 18 digit!',
      'nama.required'=>'Nama tidak boleh kosong!',
      'instansi.required'=>'Nama instansi tidak boleh kosong!',
      'jenis_kelamin.required'=>'Jenis kelamin harus diisi!',
      'golongan.required'=>'Pangkat/Golongan tidak boleh kosong!'
    ];

    if ($r->telp!='') {
      $role['telp'] = 'numeric';
      $msg['telp.numeric'] = 'No. telepon harus berupa angka tanpa spasi!';
    }

    Validator::make($r->all(),$role,$msg)->validate();

    $pegawai = Pegawai::updateOrCreate(['uuid' => $r->uuid],
    [
      'uuid' => (string)Str::uuid(),
      'nip_baru' => $r->nip_baru,
      'nip_lama' => $r->nip_lama,
      'nama' => $r->nama,
      'jenis_kelamin' => $r->jenis_kelamin,
      'alamat' => $r->alamat,
      'telp' => $r->telp,
      'golongan' => $r->golongan,
      'instansi' => $r->instansi,
      'jabatan' => $r->jabatan,
      'status' => $r->status,
    ]);

    return redirect()->route('pegawai.index')->with('message','Data Berhasil Disimpan');
  }

  public function edit($uuid)
  {

    $pegawai = Pegawai::where('uuid',$uuid)->first();

    $data = [
      'title'=>'Ubah Data Pegawai  - BKPSDMA',
      'data'=>$pegawai
    ];

    return view('pegawai.edit',$data);
  }

  public function show($uuid)
  {
    $pegawai = Pegawai::where('uuid',$uuid)->first();

    if (!$pegawai) {
      return redirect()->route('pegawai.index');
    }

    $data = [
      'title'=>'Detail Pegawai '.$pegawai->nama.' ('.$pegawai->nip_baru.')'.'  - BKPSDMA',
      'data'=>$pegawai
    ];

    return view('pegawai.show',$data);
  }

  public function destroy($uuid)
  {
    $pegawai = Pegawai::where('uuid',$uuid)->first();
    $pegawai->delete();

    return redirect()->route('pegawai.index')->with('message','Data Pegawai <strong>'.$pegawai->nip_baru.' - '.$pegawai->nama.'</strong> Berhasil Dihapus');
  }

  public function deleteFoto(Request $r)
  {
    if ($r->ajax()) {
      $foto = DrainaseFile::where('uuid',$r->uuid)->first();
      Storage::delete($foto->path);
      if ($foto->delete()) {
        return response()->json(['status'=>true]);
      }
      return response()->json(['status'=>false]);
    }
    return redirect()->route('pegawai.index');
  }

  public function printSingle($uuid)
  {
    $pegawai = Pegawai::where('uuid',$uuid)->first();

    $pdf = PDF::loadView('pegawai.print-single',[
      'title'=>$pegawai->nip_baru.' - '.$pegawai->nama.' - BKPSDMA',
      'data'=>$pegawai
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'potrait')->stream($pegawai->nip_baru.' - '.$pegawai->nama.' - BKPSDMA');
  }

  public function printAll()
  {

    $role = '%'.request()->q.'%';
    $rows = request()->rows;

    $pegawai = Pegawai::when(request()->q!='all',function($q) use($role){
      $q->where('nama','like',$role)
      ->orWhere('nip_baru','like',$role)
      ->orWhere('nip_lama','like',$role)
      ->orWhere('instansi','like',$role)
      ->orWhere('golongan','like',$role)
      ->orWhere('jabatan','like',$role)
      ->orWhere('status','like',$role);
      if (strtolower(request()->q) == 'pria' || strtolower(request()->q) == 'wanita') {
        $q->orWhere('jenis_kelamin',(strtolower(request()->q)=='pria'?1:2));
      }
    })->limit($rows)->get();


    $pdf = PDF::loadView('pegawai.print-all',[
      'title'=>'Data Pegawai ASN - BKPSDMA',
      'data'=>$pegawai
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'landscape')->stream('Data Pegawai ASN - BKPSDMA');
  }
}
