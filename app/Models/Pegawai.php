<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $table = 'pegawai';
  protected $fillable = [
  'uuid',
  'nama',
  'nip_lama',
  'nip_baru',
  'jenis_kelamin',
  'instansi',
  'jabatan',
  'golongan',
  'alamat',
  'telp',
  'foto',
  'status'
  ];
}
