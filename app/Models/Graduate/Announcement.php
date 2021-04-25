<?php

namespace App\Models\Graduate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table        = 'graduate_entity__announcement';
    protected $fillable     = [
        'announcement_uuid',
        'announcement_number',
        'announcement_value_know',
        'announcement_value_know_total',
        'announcement_value_skill',
        'announcement_value_skill_total',
        'announcement_status',
        'announcement_view',
        'announcement_print',
        'announcement_finance',
        'announcement_student',
    ];
    protected $primaryKey   = 'announcement_id';
    public $timestamps      = false;

    public function student()
    {
        return $this->hasOne(
            Student::class,
            'student_id',
            'announcement_student'
        );
    }
}
