<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipName extends Model
{
    protected $table = 'scholarship_name';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'scholarship_type', 'status']; // fillable attributes

    // public function scholarshipType()
    // {
    //     return $this->belongsTo(ScholarshipType::class, 'scholarship_type_id', 'id');
    // }

    public function fundSources()
    {
        return $this->hasMany(FundSource::class, 'scholarship_name_id', 'id');
    }

    public function getTypeScholarshipNameAttribute()
    {
        $value = $this->attributes['scholarship_type'];
        switch ($value) {
            case 0:
                return 'Government';
            case 1:
                return 'Private';
            default:
                return 'No info';
        }
    }
}
