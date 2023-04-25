<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post 
{
    public function __construct(public $title, public $excerpt, public $date, public $body, public $slug)
    {
        
    }

    public static function all()
    {
        return cache('posts.all', now()->addMinutes(5), function () {
            return collect(File::files(resource_path("posts/")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(fn($document) => new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                ))
                ->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}