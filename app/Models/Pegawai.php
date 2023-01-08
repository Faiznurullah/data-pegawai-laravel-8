<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = "pegawai";

    protected $primaryKey = "id";

    protected $fillable = [
    	'nama',
    	'alamat',
    	'gender'
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];


        

}
