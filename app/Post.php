<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'content', 'image', 'published_at', 'category_id'];

    /**
     * Delete post image from controller
     *
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
}
