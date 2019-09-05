<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $table = 'pegawai';
  protected $fillable = [
  'uuid',
  'nama',
  'gelar_depan',
  'gelar_belakang',
  'nip_lama',
  'nip_baru',
  'jenis_kelamin',
  'jabatan',
  'instansi',
  'instansi_induk',
  'golongan',
  'alamat',
  'telp',
  'foto',
  'status'
  ];
}
