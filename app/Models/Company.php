<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'company';
    protected $fillable = [
    	'company_name',
    	'address',
    	'telp'
    ];

    public function users()
    {
    	return $this->hasMany('App\Models\User');
    }
}
