<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__categories';
    protected $fillable     = ['category_name', 'category_desc'];
    protected $primaryKey   = 'category_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    public function post()
    {
        return $this->hasOne(
            Post::class,
            'post_category',
            'category_id'
        );
    }

    public function name($id)
    {
        return self::where('category_id', $id)->value('category_name');
    }
}
