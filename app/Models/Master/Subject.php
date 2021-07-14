<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_subjects';
    protected $fillable     = [
        'subject_id',
        'subject_number',
        'subject_code',
        'subject_name',
        'subject_exam',
        'subject_desc',
    ];
    protected $primaryKey   = 'subject_id';
    public $timestamps      = false;
}
