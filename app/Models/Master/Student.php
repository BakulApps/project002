<?php

namespace App\Models\Master;

namespace App\Models\Master;

use App\Models\Finance\Lack;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_students';
    protected $fillable     = [
        'student_id',
        'student_name',
        'student_nisn',
        'student_civic',
        'student_nik',
        'student_birthplace',
        'student_birthday',
        'student_gender',
        'student_siblingplace',
        'student_sibling',
        'student_religion',
        'student_purpose',
        'student_phone',
        'student_mail',
        'student_hobby',
        'student_residence',
        'student_address',
        'student_province',
        'student_distric',
        'student_subdistric',
        'student_village',
        'student_postal',
        'student_transport',
        'student_distance',
        'student_travel',
        'student_financed',
        'student_im_hepatitis','student_im_polio',
        'student_im_bcg','student_im_campak','student_im_dpt','student_im_covid','student_tk','student_paud',
        'student_kip_no',
        'student_kip_file',
        'student_kk_file',

        'student_kk_no',
        'student_head_family',
        'student_father_name',
        'student_father_status',
        'student_father_civic',
        'student_father_nik',
        'student_father_birthplace',
        'student_father_birthday',
        'student_father_study',
        'student_father_job',
        'student_father_earning',
        'student_father_phone',
        'student_mother_name',
        'student_mother_status',
        'student_mother_civic',
        'student_mother_nik',
        'student_mother_birthplace',
        'student_mother_birthday',
        'student_mother_study',
        'student_mother_job',
        'student_mother_earning',
        'student_mother_phone',

        'student_regent_name',
        'student_regent_status',
        'student_regent_civic',
        'student_regent_nik',
        'student_regent_birthplace',
        'student_regent_birthday',
        'student_regent_study',
        'student_regent_job',
        'student_regent_earning',
        'student_regent_phone',

        'student_home_domicile',
        'student_home_owner',
        'student_home_province',
        'student_home_distric',
        'student_home_subdistric',
        'student_home_village',
        'student_home_address',
        'student_home_postal',

        'student_kks_no',
        'student_kks_file',
        'student_pkh_no',
        'student_pkh_file',
        'student_photo_file',
        'student_akta_file',
        'student_ijazah_file',
        'student_skhun_file',
    ];

    protected $primaryKey   = 'student_id';

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

    public function regentbirthday($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->student_regent_birthday)->translatedFormat($format);
    }

    public function classes()
    {
        return $this->belongsToMany(
            Classes::class,
            'student_entity__classes',
            'student_id',
            'class_id'
        );
    }

    public function lack()
    {
        return $this->hasMany(
            Lack::class,
            'lack_student',
            'student_id'
        );
    }
}
