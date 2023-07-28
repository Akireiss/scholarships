<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundSource extends Model
{
    protected $table = 'fund_sources';
    protected $fillable = ['source_name', 'scholarship_name_id']; // fillable attributes
    protected $primaryKey = 'source_id'; // Specify the primary key column
    public $incrementing = false; // Set to false to indicate the primary key is not auto-incrementing

    public function scholarshipName()
    {
        return $this->belongsTo(ScholarshipName::class, 'scholarship_name_id', 'id');
    }
}
