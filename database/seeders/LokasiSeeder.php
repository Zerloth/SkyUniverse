<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\factory as Faker;
use Illuminate\Support\Facades\DB;


class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lokasi = array("Jakarta", "Singapore", "Tangerang");
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 25; $i++) {
            Lokasi::create([
                'lokasi' => $lokasi[rand(0, 2)],
                'harga' => $faker->numberBetween($min = 100000, $max = 9000000),
                'alamat' => $faker->address
            ]);
        }
    }
}
