<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $content = fake()->text();
        $folderPath = 'public/books/';


        $filePath =   $folderPath . Str::uuid()->toString() . '.pdf';;

        // Storage::put($filePath, $content);
        Storage::put($filePath, $content, 'public', ['mimetype' => 'application/pdf']);


        $randomUser = User::inRandomOrder()->first();
        $fileSize = Storage::size($filePath);


        return [
            'title' => basename($filePath),
            'description' => "this is test file ",
            'url' => asset(Storage::url($filePath)),
            'extension' =>   File::extension($filePath),
            'file_size' =>  $fileSize,
            'user_id' => $randomUser->id,

        ];
    }
}
