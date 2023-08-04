<?php

namespace App\Models;

use App\Models\Municipal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barangay extends Model
{
    use HasFactory;

    protected $table = 'barangays';
    protected $primaryKey = 'barangay_id';
    protected $fillable = ['brgyCode', 'brgyDesc', 'regCode', 'provCode', 'citynumCode'];

    public function municipal()
    {
        return $this->belongsTo(Municipal::class, 'municipality_id');
    }
}
