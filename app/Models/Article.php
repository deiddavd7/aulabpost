<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'body',
        'image',
        'category_id',
        'user_id',
        'is_accepted',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (
            self::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->body));

        return max(1, ceil($words / 200));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

