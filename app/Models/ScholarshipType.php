<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipType extends Model
{
    protected $table = 'scholarship_type';
    protected $primaryKey = 'id';

    public function scholarships()
    {
        return $this->hasMany(ScholarshipName::class, 'scholarship_type_id', 'id');
    }

}
