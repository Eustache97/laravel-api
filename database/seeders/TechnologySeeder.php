<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['Html', 'Css', 'Sass', 'Vue.js', 'Js', 'Bootstrap', 'Php', 'Laravel'];

        foreach ($technologies as $technology) {
            $new_tech = new Technology();
            $new_tech->title = $technology;
            $new_tech->slug = Str::slug($new_tech->title, '-');
            $new_tech->save();
        }
    }
}
