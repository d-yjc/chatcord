<?php

namespace Database\Seeders;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $testComment = new Comment;
        $testComment->body = "stop necro posting brah!";
        $testComment->save();

        Comment::factory()->count(50)->create();
    }
}
