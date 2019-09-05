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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Ods;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PegawaiController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index()
  {

    if (request()->ajax()) {
      $data = Pegawai::query();
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
      'gelar_depan' => $r->gelar_depan,
      'gelar_belakang' => $r->gelar_belakang,
      'jenis_kelamin' => $r->jenis_kelamin,
      'alamat' => $r->alamat,
      'telp' => $r->telp,
      'golongan' => $r->golongan,
      'jabatan' => $r->jabatan,
      'instansi' => $r->instansi,
      'instansi_induk' => $r->instansi_induk,
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
      ->orWhere('golongan','like',$role)
      ->orWhere('jabatan','like',$role)
      ->orWhere('instansi','like',$role)
      ->orWhere('instansi_induk','like',$role)
      ->orWhere('status','like',$role);
      if (strtolower(request()->q) == 'pria' || strtolower(request()->q) == 'wanita') {
        $q->orWhere('jenis_kelamin',(strtolower(request()->q)=='pria'?1:2));
      }
    })
    ->orderBy('id','asc')->paginate($rows, ['*'], 'page');


    $pdf = PDF::loadView('pegawai.print-all',[
      'title'=>'Data Pegawai ASN - BKPSDMA',
      'data'=>$pegawai
    ]);

    return $pdf->setPaper([0,0,609.449,935.433],'landscape')->stream('Data Pegawai ASN - BKPSDMA');
  }

  public function import(Request $r)
  {
    if ($r->file_excel == null) {
      return redirect()->back()->withErrors('File harus diupload!');
    }
    if ($r->file('file_excel')->isValid()) {
      $ext = ['xlsx','xls','bin','ods'];
      if (in_array($r->file_excel->getClientOriginalExtension(),$ext)) {
        $spreadsheet = IOFactory::load($r->file_excel->path());
        $sheet = $spreadsheet->getActiveSheet();

        $arr = $spreadsheet->getSheet(0)->toArray();

        if ($arr[3][1] != 'NIP') {
          return redirect()->back()->withErrors('File yang diupload tidak sesuai format!');
        }

        if ($r->status == 'new') {
          Pegawai::truncate();
        }

        foreach ($arr as $krow => $row) {
          if ($krow > 6) {
            if ($arr[$krow][1] == '') {
              continue;
            }
            $data = [];
            foreach ($row as $kcol => $col) {
              if ($arr[6][$kcol] == 2) {
                $data['nip_baru'] = (int)trim($col);
                $data ['jenis_kelamin'] = trim(@$col[14])??1;
                $data['uuid'] = (string)Str::uuid();
              }
              if ($arr[6][$kcol] == 3) {
                $data['nip_lama'] =$col?(int)trim($col):null;
              }
              if ($arr[6][$kcol] == 4) {
                $data['nama'] = trim($col);
              }
              if ($arr[6][$kcol] == 5) {
                $data['gelar_depan'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 6) {
                $data['gelar_belakang'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 7) {
                $data['alamat'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 13) {
                $data['golongan'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 19 && $arr[$krow][$kcol] != '') {
                $data['jabatan'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 21 && $arr[$krow][$kcol] != '') {
                $data['jabatan'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 22 && $arr[$krow][$kcol] != '') {
                $data['jabatan'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 23) {
                $data['instansi'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 24) {
                $data['instansi_induk'] = trim($col)??null;
              }
              if ($arr[6][$kcol] == 27) {
                $data['status'] = trim($col)??null;
              }
              if ($kcol > 29) {
                break;
              }
            }
            $import = Pegawai::updateOrCreate(['nip_baru'=>$data['nip_baru']],$data);
          }
        }

        if ($import) {
          return redirect()->back()->with('message', 'Data berhasil diimport.');
        }else {
          return redirect()->back()->with('message', 'Kesalahan saat mengimport data atau format file tidak benar!');
        }

      }

    }
    return redirect()->back()->withErrors('File yang diupload tidak sesuai format!');
  }
}
