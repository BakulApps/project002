<?php

namespace App\Models\Admission;

use App\Models\Student\Program;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__costs';
    protected $fillable     = ['cost_id', 'cost_program', 'cost_boarding', 'cost_price'];
    protected $primaryKey   = 'cost_id';

    public $timestamps      = false;

    public function program()
    {
        return $this->hasOne(
            Program::class,
            'program_id',
            'cost_program'
        );
    }
}
