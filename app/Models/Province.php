<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $primaryKey = 'province_id';
    protected $fillable = ['psgcCode', 'provDesc', 'provCode'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
