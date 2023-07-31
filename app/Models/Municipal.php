<?php

namespace App\Models;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipal extends Model
{
    use HasFactory;

    protected $table = 'municipals';

    protected $fillbale = [
        'name',
        'province_id'
    ];

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'municipality_id', 'id');
    }
}
