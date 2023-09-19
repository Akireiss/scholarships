<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    protected $fillable = ['psgcCode', 'provDesc', 'regCode' , 'provCode'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id');
    }
}
