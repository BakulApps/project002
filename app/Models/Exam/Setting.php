<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__settings';
    protected $fillable     = ['setting_name', 'setting_value'];

    protected $primaryKey   = 'setting_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function value($value)
    {
        return self::where('setting_name', $value)->value('setting_value');
    }
}
