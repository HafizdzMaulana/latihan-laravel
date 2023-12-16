<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Catagory extends Model
{
    use HasFactory, sluggable;
    
    protected $guarded = ['id'];

    public function post()
    {
        return $this->hasMany(Post::class, 'foreign_id', 'id');
        
        // return $this->hasMany(Post::class(class-tabel yang akan direlasikan), 'foreign_id(tabel no1?)', 'id(tabel yang akan di JOIN)');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'foreign_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
