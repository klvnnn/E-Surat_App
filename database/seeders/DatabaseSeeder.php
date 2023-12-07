<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
    DB::table('users')->insert([
      'name' => 'Super Admin',
      'email' => 'admin@kksp.id',
      'password' => Hash::make('super_admin'),
      'role' => 'Super Admin',
    ]);

    // $faker = Faker::create();

    // foreach (range(1, 1000) as $index) {
    //   $urut = $index + 0;
    //   $angkaFormatted = str_pad($urut, 3, '0', STR_PAD_LEFT);

    //   DB::table('letters')->insert([
    //     'letter_date' => $faker->date,
    //     'letter_no' => $angkaFormatted++,
    //     'letter_code' => 'PJJ',
    //     'letter_unit' => 'DST',
    //     'regarding' => $faker->sentence,
    //     'department' => $faker->word,
    //     'letter_type' => 'Surat Keluar',
    //   ]);
    // }
  }
}
