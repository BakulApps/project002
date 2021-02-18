<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table    = 'portal_entity__users';
    protected $fillable = [
        'user_fullname',
        'user_name',
        'user_pass',
        'user_desc',
        'user_email',
        'user_role',
        'remember_token',
        'user_facebook',
        'user_instagram',
        'user_twitter'
    ];
    protected $hidden       = ['password', 'remember_token',];
    protected $casts        = ['email_verified_at' => 'datetime',];
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
