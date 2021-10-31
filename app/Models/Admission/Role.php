<?php

namespace App\Models\Admission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__roles';
    protected $fillable     = ['role_id', 'role_name', 'role_desc'];
    protected $primaryKey   = 'role_id';

    public $timestamps      = false;

    public function user()
    {
        return $this->hasOne(
            User::class,
            'role_id',
            'user_role'
        );
    }
}
