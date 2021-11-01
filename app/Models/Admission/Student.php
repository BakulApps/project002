<?php

namespace App\Models\Admission;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__students';
    protected $fillable     = ['student_name', 'student_nisn', 'student_nik', 'student_birthplace', 'student_birthday',
        'student_gender', 'student_religion', 'student_siblingplace', 'student_sibling', 'student_civic', 'student_hobby',
        'student_purpose', 'student_email', 'student_phone', 'student_im_hepatitis', 'student_im_polio', 'student_im_bcg',
        'student_im_campak', 'student_im_dpt', 'student_im_covid', 'student_residence', 'student_address', 'student_province',
        'student_distric', 'student_subdistric', 'student_village', 'student_postal', 'student_distance', 'student_transport',
        'student_travel', 'student_program', 'student_boarding', 'student_no_kk', 'student_head_family', 'student_father_name',
        'student_mother_name', 'student_gurad_name', 'student_father_birthday', 'student_mother_birthday', 'student_guard_birthday',
        'student_father_status', 'student_mother_status', 'student_father_nik', 'student_mother_nik', 'student_guard_nik',
        'student_father_study', 'student_mother_study', 'student_guard_study', 'student_father_job', 'student_mother_job',
        'student_guard_job', 'student_father_earning', 'student_mother_earning', 'student_guard_earning', 'student_father_phone',
        'student_mother_phone', 'student_guard_phone', 'student_home_owner', 'student_home_address', 'student_home_postal',
        'student_home_province', 'student_home_distric', 'student_home_subdistric', 'student_home_village', 'student_swaphoto',
        'student_ktp_photo', 'student_akta_photo', 'student_kk_photo', 'student_ijazah_photo', 'student_skhun_photo',
        'student_sholarship_photo', 'student_school_from', 'student_school_name', 'student_school_npsn', 'student_school_address',
        'student_creater', 'student_update'
    ];

    protected $primaryKey   = 'student_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function birthday($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->student_birthday)->translatedFormat($format);
    }

    public function fatherbirthday($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->student_father_birthday)->translatedFormat($format);
    }

    public function motherbirthday($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->student_mother_birthday)->translatedFormat($format);
    }

    public function guardbirthday($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->student_guard_birthday)->translatedFormat($format);
    }

    public function form()
    {
        return $this->hasOne(
            Form::class,
            'student_id',
            'form_student'
        );
    }
}
