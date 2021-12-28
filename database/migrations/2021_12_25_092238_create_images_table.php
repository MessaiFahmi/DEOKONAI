<?php

use Deokonai\Models\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('file')->unique();
            $table->string('type', 50);
            $table->timestamps();
        });

        foreach(scandir(storage_path('app/public/img')) as $file) {
            if(!in_array($file, ['.', '..'])) {
                $name = pathinfo($file, PATHINFO_FILENAME);
                $type = pathinfo($file, PATHINFO_EXTENSION);
                Image::create([
                    'name' => $name,
                    'file' => $file,
                    'type' => $type
                ]);
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }



}
