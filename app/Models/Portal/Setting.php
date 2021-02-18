<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__settings';
    protected $fillable     = ['setting_name', 'setting_value'];
    protected $primaryKey   = 'setting_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function value($setting_name)
    {
        return self::where('setting_name', $setting_name)->value('setting_value');
    }

}
