<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a Faker instance
        $faker = Faker::create('en_US');

        // Define base URL for random images (using Picsum Photos as an example)
        $baseUrl = "https://picsum.photos/400/300";

        // Generate a unique image name using UUID and a descriptive string
        $imageName = Str::uuid() . '_' . $faker->word . '.jpg';  // e.g., 0b8ccff4-bbf7-43c1-9ff0-70ec58571deb_beatae.jpg

        // Use storage disk to store the image in the public storage path
        $imagePath = 'car_pics/' . $imageName;  // Store this relative path

        // Download the image from the external URL
        $imageContents = file_get_contents($baseUrl);

        // Store the image in public storage
        Storage::disk('public')->put($imagePath, $imageContents);

        // Return the model attributes, including the relative image path
        return [
            'user_id' => User::all()->random()->id,
            'name' => $faker->name,
            'color' => $faker->colorName,
            'year' => $faker->year,
            'description' => $faker->paragraph(1),
            'image' => '/' . $imagePath,  // Save the relative path
        ];
    }
}
