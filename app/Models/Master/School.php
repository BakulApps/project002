<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_schools';
    protected $fillable     = [
        'school_fundation',
        'school_ladder',
        'school_name',
        'school_slug',
        'school_logo',
        'school_nsm',
        'school_npsn',
        'school_phone',
        'school_email',
        'school_website',
        'school_address',
        'school_postal',
        'school_headmaster_name',
        'school_headmaster_nip',
    ];
    public $timestamps      = false;

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
            $name = $school->ladder->ladder_code .". ". $school->school_name;
        }

        return $name;
    }
}
