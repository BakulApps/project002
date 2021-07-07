<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__teachers';
    protected $fillable     = [
        'teacher_id',
        'teacher_name',
        'teacher_job',
        'teacher_mail',
        'teacher_facebook',
        'teacher_twitter',
        'teacher_instagram',
        'teacher_about',
        'teacher_achievement',
        'teacher_desc',
        'teacher_image'
    ];
    protected $primaryKey   = 'teacher_id';

    public $timestamps      = false;
}
