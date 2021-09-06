<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'nama_instansi', 'alamat_instansi', 'kecamatan', 'kota', 'penanggungjawab_instansi', 'pembawa', 'nomor_proposal', 'judul', 'company_id'
    ];
}
