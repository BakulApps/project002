<?php

namespace App\Models\Graduate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Notifications\Notifiable;

class User extends Authenticated
{
    use HasFactory, Notifiable;

    protected $table        = 'graduate_entity__users';
    protected $fillable     = [
        'user_id',
        'user_name',
        'user_pass',
        'user_fullname',
        'remember_token',
    ];
    protected $hidden = ['user_pass', 'remember_token'];
    protected $primaryKey   = 'user_id';
    public $timestamps  = false;

    public function getAuthPassword()
    {
        return $this->user_pass;
    }
}
