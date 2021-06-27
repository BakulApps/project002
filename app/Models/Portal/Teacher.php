<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__teachers';
    protected $fillable     = ['teacher_id', 'teacher_name', 'teacher_job', 'teacher_image'];
    protected $primaryKey   = 'teacher_id';

    public $timestamps      = false;
}
