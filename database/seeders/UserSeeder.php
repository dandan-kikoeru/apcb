<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::factory()
      ->count(10)
      ->hasPost(3)
      ->create();

    User::factory()
      ->count(3)
      ->hasPost(10)
      ->create();

    User::factory()
      ->count(3)
      ->create();

    User::factory()
      ->hasPost(50)
      ->create();
  }
}
