<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
	protected $table ='akun';
    protected $fillable = ['jenis_akun', 'nama_akun'];
}
