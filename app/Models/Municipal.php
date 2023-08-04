<?php

namespace App\Models;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipal extends Model
{
    use HasFactory;

    protected $table = 'municipals';
    protected $primaryKey = 'municipality_id';
    protected $fillable = ['psgcCode', 'citynumDesc', 'regCode', 'provCode', 'citynumCode'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
