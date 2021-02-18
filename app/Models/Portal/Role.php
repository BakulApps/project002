<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__roles';
    protected $fillable     = ['role_name', 'role_desc'];
    protected $primaryKey   = 'role_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function user()
    {
        return $this->hasOne(
            User::class,
            'user_role',
            'role_id'
        );
    }
}
