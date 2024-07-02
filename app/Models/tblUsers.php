<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblUsers extends Model
{
    protected $table = 'tbl_users'; /* nombre de la tabla segun en mysql */
    protected $primaryKey = 'idx'; 
    use HasFactory;
}
