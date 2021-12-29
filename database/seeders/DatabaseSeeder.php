<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123456'),
        ]);


        foreach (range(1, 50) as $_) {
            $name = $faker->firstName;
            $surname = $faker->lastName;
            DB::table('authors')->insert([
                'name' => $name,
                'surname' => $surname,
                'photo' => rand(0, 4) ? $faker->imageUrl(200, 250, $name . ' ' . $surname, false) : null

            ]);
        }

        $titles = [
            'vienos dienos nuotykis',
            'vienos nakties nuotykis',
            'menulio vaivorykste',
            'kapitonas vrungelis',
            'generolas kugelis',
            'grazusis brisius',
            'gaidys be balso',
            'kaciu valsas'
        ];

        foreach (range(1, 100) as $_) {
            DB::table('books')->insert([
                'title' => $faker->realText(rand(10, 30), 1),
                'isbn' => $faker->isbn13,
                'pages' => rand(10, 200),
                'about' => $faker->realText(rand(100, 300), rand(1, 4)),
                'author_id' => rand(1, 50)
            ]);
        }

        foreach (range(1, 100) as $id) {
            if (!rand(0, 4)) {
                continue;
            }
            $main = true;
            foreach (range(1, rand(1, 8)) as $_) {
                DB::table('book_photos')->insert([
                    'photo' =>  $faker->imageUrl(200, 250, 'ID: ' . $id, false),
                    'book_id' => $id,
                    'main' => $main ? 1 : null
                ]);
                $main = false;
            }
        }



        $brands = [
            'Nike', 'Adidas', 'Reebok', 'Chanel', 'Prada', 'Puma', 'D&G', 'Vans', 'Levis', 'Wrangler', 'Audimas'
        ];
        foreach (range(1, 100) as $_) {
            $title = $faker->company;
            DB::table('brands')->insert([
                'title' => $title,
                'photo' => rand(0, 4) ? $faker->imageUrl(200, 250, $title, false) : null


            ]);
        }



        $outfits = [
            'Kelnės', 'Džinsai', 'Švarkas', 'Suknelė', 'Sijonas', 'Šortai',
            'Striukė', 'Paltas', 'Puspaltis', 'Šūba', 'Marškiniai', 'Kojinės',
            'Liemenė', 'Megztinis', 'Kepurė'
        ];

        $colors = [
            'Mėlyna', 'Raudona', 'Žalia', 'Geltona', 'Ruda', 'Balta', 'Juoda'
        ];

        foreach (range(1, 100) as $_) {
            DB::table('outfits')->insert([
                'type' => $outfits[rand(0, count($outfits) - 1)],
                'color' => $faker->colorName,
                'price' => rand(1, 9999) / 100,
                'discount' => rand(1, 9999) / 100,
                'brand_id' => rand(1, 50)
            ]);
        }

        foreach (range(1, 100) as $id) {
            if (!rand(0, 4)) {
                continue;
            }
            $main = true;
            foreach (range(1, rand(1, 8)) as $_) {
                DB::table('outfit_photos')->insert([
                    'photo' =>  $faker->imageUrl(200, 250, 'ID: ' . $id, false),
                    'outfit_id' => $id,
                    'main' => $main ? 1 : null
                ]);
                $main = false;
            }
        }

        foreach (range(1, 15) as $_) {
            DB::table('tags')->insert([

                'name' => $faker->streetName(),

            ]);
        }
    }
}
