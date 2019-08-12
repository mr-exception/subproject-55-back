<?php

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Task::create([
      'id_str' => '730997261333843968',
      'type' => Task::FETCH_USER,
    ]);
  }
}
