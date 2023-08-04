<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\jobs>
 */
class jobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $images= ['acme.png','skynet.png','stark.png','wayne.png','wonka.png'];
            return [
                'title'=>$this->faker->sentence(),
                'tags'=>$this->faker->word(4) . "," . $this->faker->word(5) ."," . $this->faker->word(6) ."," . $this->faker->word(3) ."," . $this->faker->word(8),
                'company'=>$this->faker->company(),
                'email'=>$this->faker->companyEmail(),
                'website'=>$this->faker->url(),
                'location'=>$this->faker->city(),
                'description'=>$this->faker->paragraph(15),
                'logo'=>'logos/'. $images[rand(0,4)]
            ];
    }
}
