<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__users';
    protected $fillable     = ['user_image', 'user_fullname', 'user_name', 'user_pass', 'user_email', 'user_role', 'user_desc'];


    protected $primaryKey   = 'user_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }
}
