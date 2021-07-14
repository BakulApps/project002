<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table        = 'student_entity__settings';
    protected $fillable     = [
        'setting_name',
        'setting_value',
    ];
    protected $primaryKey   = 'setting_id';
    public $timestamps      = false;

    public function value($setting_name)
    {
        return $this->where('setting_name', $setting_name)->value('setting_value');
    }
}
