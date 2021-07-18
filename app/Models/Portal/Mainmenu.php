<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainmenu extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__menus';
    protected $fillable     = ['menu_id', 'menu_parent', 'menu_name', 'menu_link'];
    protected $primaryKey   = 'menu_id';

    public $timestamps      = false;
}
