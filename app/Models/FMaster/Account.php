<?php

namespace App\Models\FMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//ganti 1
class Account extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'account';
    protected $primaryKey = 'NO_ID';
    public $timestamps = true;

//ganti 3
    protected $fillable = 
    [
        "ACNO", "NAMA", "created_by", "updated_by", "deleted_by"
		
    ];
}
