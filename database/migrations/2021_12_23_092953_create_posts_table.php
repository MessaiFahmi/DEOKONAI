<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('body');
            $table->string('user_uuid');
            $table->foreign('user_uuid')->references('uuid')->on('users');
            $table->timestamps();
        });

        for ($i=0; $i < 15; $i++) { 
            Post::create([
                'title' => 'Post ' . $i,
                'slug' => 'post-' . $i,
                'category_id' => 1,
                'body' => 'Lorem Ipsum...',
                'user_uuid' => User::all()->first()->uuid,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
