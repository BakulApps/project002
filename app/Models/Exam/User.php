<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table        = 'exam_entity__users';
    protected $fillable     = ['user_image', 'user_fullname', 'user_name', 'user_pass', 'user_email', 'user_role', 'user_desc', 'remember_token'];
    protected $hidden       = ['password', 'remember_token',];
    protected $primaryKey   = 'user_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function getAuthPassword()
    {
        return $this->user_pass;
    }

    public function role()
    {
        return $this->hasOne(
            Role::class,
            'role_id',
            'user_role'
        );
    }
}
