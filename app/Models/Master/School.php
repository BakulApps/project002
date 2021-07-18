<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_schools';
    protected $fillable     = [
        'school_npsn',
        'school_nsm',
        'school_name',
        'school_nickname',
        'school_slug',
        'school_status',
        'school_ladder',
        'school_npwp',
        'school_phone',
        'school_website',
        'school_email',
        'school_since_year',
        'school_since_deed',
        'school_lisence_number',
        'school_lisence_date',
        'school_kemenkumham_number',
        'school_kemenkumham_date',
        'school_organizer',
        'school_fundation',
        'school_affiliate',
        'school_study_time',
        'school_kkm',
        'school_parent',
        'school_committee',
        'school_address',
        'school_village',
        'school_subdistric',
        'school_distric',
        'school_province',
        'school_postal',
        'school_headmaster_name',
        'school_headmaster_nip',
        'school_logo',
    ];
    public $timestamps      = false;
    protected $primaryKey   = 'school_id';

    public function ladder()
    {
        return $this->hasOne(
            Ladder::class,
            'ladder_id',
            'school_ladder'
        );
    }

    public function name($full = true)
    {
        $school = self::first();
        if ($full == true){
            $name = $school->ladder->ladder_name ." ". $school->school_name;
        }
        else {
            $name = $school->ladder->ladder_code ." ". $school->school_name;
        }

        return $name;
    }
}
