<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    //protected $fillable = ['title', 'excerpt', 'body'];
    protected $guarded = ['id'];

    public function scopeSearch($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%'. $search . '%')
                    ->orWhere('body', 'like', '%'. $search . '%');
        });

        $query->when($filters['catagory'] ?? false, function($query, $catagory){
            return $query->whereHas('catagory', function($query) use($catagory){
                $query->where('slug', $catagory);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $user){
            return $query->whereHas('user', function($query) use($user){
                $query->where('username', $user);
            });
        });

        
    }

    public function catagory()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
