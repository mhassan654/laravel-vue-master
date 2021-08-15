<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
         'post',
         'post_excerpt',
         'slug',
         'user_id',
         'featuredImage',
         'metaDescription',
         'views'
    ];

    public function setSlugAttribute($title){
        $this->attributes['slug'] = $this->uniqueSlug($title);
    }

    private function uniqueSlug($title){
        $slug = Str::slug($title, '-');
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        $newcount = $count > 0 ? ++$count : '';
        return $newcount > 0 ? "$slug-$newcount" : $slug;
    }

    public function tag(){
        return $this->belongsToMany('App\Models\Tag','blogtags');
    }


    public function cat(){
        return $this->belongsToMany('App\Models\Category','blogcategories');
    }

    /**
     * Get the user that owns the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
