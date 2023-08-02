<?php

namespace App\Models;

use App\Models\Municipal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barangay extends Model
{
    use HasFactory;

    protected $table = 'barangays';

    protected $fillable = [
        'name',
        'municipal_id'
    ];

    public function municipal()
    {
        return $this->belongsTo(Municipal::class, 'municipal_id');
    }
}