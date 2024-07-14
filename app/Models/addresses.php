<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addresses extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'street','number_ext','zip_code','city','country','principal'];
    public $timestamps = false;
    use HasFactory;
    
    public function addresses(){
        return $this->hasMany(Address::class, 'id');
    }
}
