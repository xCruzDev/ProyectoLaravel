<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{

    protected $table = 'clients';
    protected $primaryKey = 'id';

    use HasFactory;
    public function addresses() {
        return $this->belongsTo(addresses::class, 'id');
    }
}
