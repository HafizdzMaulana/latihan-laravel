<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Catagory;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        User::factory()->create([
            'name' => 'maulana',
            'username' => 'maulana',
            'email' => 'maulana@gmail.com',
            'role_id' => '1',
            'password' => bcrypt('12345678')
        ]);
        // Post::create([
        //     'foreign_id' => '1',
        //     'user_id' => '1',
        //     'nama' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim minus dolor ea sed magnam. Impedit!',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis eius ipsam quod quas ratione obcaecati voluptatum enim et molestias incidunt tempore porro nihil, dolor sapiente!</p>
        //     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore illum nostrum vitae eius accusantium perferendis quasi, delectus sapiente quo laudantium non. Veritatis nulla deserunt ullam.</p>
        //     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas et minus reprehenderit. Facilis, sunt rerum pariatur deleniti molestias eius dignissimos? Animi esse amet itaque beatae.</p>'
        // ]);

        Catagory::create([
            'title' => 'Progamming',
            'slug' => 'progamming'
        ]);

        Catagory::create([
            'title' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Catagory::create([
            'title' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();
    }
}
