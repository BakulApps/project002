<?php

namespace App\Models\Portal;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__posts';
    protected $fillable     = ['post_image', 'post_author', 'post_category', 'post_title', 'post_content', 'post_comment', 'post_status'];
    protected $primaryKey   = 'post_id';

    public function tag()
    {
        return $this->belongsToMany(
            Tag::class,
            'portal_entity__posts_tag',
            'post_id',
            'tag_id'
        );
    }

    public function comment()
    {
        return $this->belongsToMany(
            Comment::class,
            'portal_entity__posts_comment',
            'post_id',
            'comment_id'
        );
    }

    public function category()
    {
        return $this->hasOne(
            Category::class,
            'category_id',
            'post_category'
        );
    }

    public function user()
    {
        return $this->hasOne(
            User::class,
            'user_id',
            'post_author'
        );
    }

    public function created_at($format = null)
    {
        if ($format != null){
            return Carbon::parse($this->created_at)->translatedFormat($format);
        }
        else {
            return Carbon::parse($this->created_at)->translatedFormat('d M Y');
        }
    }

    static function value($id, $coloumn)
    {
        return self::find($id)->value($coloumn);
    }
}
