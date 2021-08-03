<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table  = 'kas';
    protected $fillable = [
        'jenis_akun', 'akun_id', 'jumlah', 'tanggal_mutasi', 'user_id', 'company_id', 'note', 'saldo'
    ];
    
}
