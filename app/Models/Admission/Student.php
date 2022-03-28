<?php

namespace App\Models\Admission;

use App\Models\Master\Territory;
use App\Models\Student\Program;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__students';
    protected $fillable     = ['student_id', 'student_name', 'student_nisn', 'student_nik', 'student_birthplace', 'student_birthday',
        'student_gender', 'student_religion', 'student_siblingplace', 'student_sibling', 'student_civic', 'student_hobby',
        'student_purpose', 'student_email', 'student_phone', 'student_im_hepatitis', 'student_im_polio', 'student_im_bcg',
        'student_im_campak', 'student_im_dpt', 'student_im_covid', 'student_residence', 'student_address', 'student_province',
        'student_distric', 'student_subdistric', 'student_village', 'student_postal', 'student_distance', 'student_transport',
        'student_travel', 'student_program', 'student_boarding', 'student_no_kk', 'student_head_family', 'student_father_name',
        'student_mother_name', 'student_guard_name', 'student_father_birthday', 'student_mother_birthday', 'student_guard_birthday',
        'student_father_status', 'student_mother_status', 'student_father_nik', 'student_mother_nik', 'student_guard_nik',
        'student_father_study', 'student_mother_study', 'student_guard_study', 'student_father_job', 'student_mother_job',
        'student_guard_job', 'student_father_earning', 'student_mother_earning', 'student_guard_earning', 'student_father_phone',
        'student_mother_phone', 'student_guard_phone', 'student_home_owner', 'student_home_address', 'student_home_postal',
        'student_home_province', 'student_home_distric', 'student_home_subdistric', 'student_home_village', 'student_swaphoto',
        'student_ktp_photo', 'student_akta_photo', 'student_kk_photo', 'student_ijazah_photo', 'student_skhun_photo',
        'student_school_from', 'student_school_name', 'student_school_npsn', 'student_school_address', 'student_creater',
        'student_update', 'student_kip_no', 'student_kip_file', 'student_pkh_no', 'student_pkh_file', 'student_kks_no',
        'student_kks_file'
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

    public function payment()
    {
        return $this->hasOne(
            Payment::class,
            'payment_student',
            'student_id'
        );
    }

    public function invoice()
    {
        return $this->hasOne(
            Invoice::class,
            'invoice_student',
            'student_id'
        );
    }

    public function program()
    {
        return $this->hasOne(
            Program::class,
            'program_id',
            'student_program'
        );
    }

    public function address()
    {
        return $this->student_address .', '.
            Territory::village($this->student_subdistric, $this->student_village, false) .', '.
            Territory::subdistric($this->student_subdistric, false);
    }

    public function checkdata()
    {
        if ($this->student_name == null || $this->student_nik == null || $this->student_birthplace == null
            || $this->student_birthday == null || $this->student_gender == null || $this->student_religion == null
            || $this->student_siblingplace == null || $this->student_sibling == null || $this->student_civic == null
            || $this->student_hobby == null || $this->student_purpose == null || $this->student_email == null
            || $this->student_phone == null || $this->student_residence == null || $this->student_address == null
            || $this->student_province == null || $this->student_distric == null || $this->student_subdistric == null
            || $this->student_village == null || $this->student_postal == null || $this->student_distance == null
            || $this->student_transport == null || $this->student_travel == null || $this->student_program == null
            || $this->student_boarding == null || $this->student_no_kk == null || $this->student_head_family == null
            || $this->student_father_name == null || $this->student_mother_name == null || $this->student_guard_name == null
            || $this->student_father_birthday == null || $this->student_mother_birthday == null || $this->student_guard_birthday == null
            || $this->student_father_status == null || $this->student_mother_status == null || $this->student_father_nik == null
            || $this->student_mother_nik == null || $this->student_guard_nik == null || $this->student_father_study == null
            || $this->student_mother_study == null || $this->student_guard_study == null || $this->student_father_job == null
            || $this->student_mother_job == null || $this->student_guard_job == null || $this->student_father_earning == null
            || $this->student_mother_earning == null || $this->student_guard_earning == null || $this->student_father_phone == null
            || $this->student_mother_phone == null || $this->student_guard_phone == null || $this->student_home_owner == null
            || $this->student_home_address == null || $this->student_home_postal == null || $this->student_home_province == null
            || $this->student_home_distric == null || $this->student_home_subdistric == null || $this->student_home_village == null
            || $this->student_swaphoto == 0 || $this->student_ktp_photo == 0 || $this->student_akta_photo == 0
            || $this->student_kk_photo == 0 || $this->student_school_from == null || $this->student_school_name == null
            || $this->student_school_npsn == null || $this->student_school_address == null
        )
        {return false;}
        else {return true;}
    }
}
