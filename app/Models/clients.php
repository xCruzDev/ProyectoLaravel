<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{

    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['user_name','name','last_name','balance','credit_limit','discount'];
    public $timestamps = false;

    use HasFactory;
    public function addresses() {
        return $this->belongsTo(addresses::class, 'id');
    }
}
