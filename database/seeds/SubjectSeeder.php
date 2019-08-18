<?php

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Subject::create(['id' => 1, 'title' => 'طنز']);
    Subject::create(['id' => 2, 'title' => 'تلخ']);
    Subject::create(['id' => 3, 'title' => 'شاد']);
    Subject::create(['id' => 4, 'title' => 'غمگین']);
    Subject::create(['id' => 5, 'title' => 'سیاست']);
    Subject::create(['id' => 6, 'title' => 'هنر']);
    Subject::create(['id' => 7, 'title' => 'شعر']);
    Subject::create(['id' => 8, 'title' => 'فلسفه']);
    Subject::create(['id' => 9, 'title' => 'ادبیات']);
    Subject::create(['id' => 10, 'title' => 'تکنولوژی']);
    Subject::create(['id' => 11, 'title' => 'خبر']);
    Subject::create(['id' => 12, 'title' => 'زندگی خصوصی']);
    Subject::create(['id' => 13, 'title' => 'سفر']);
    Subject::create(['id' => 14, 'title' => 'تاریخ']);
    Subject::create(['id' => 15, 'title' => 'شعار']);
    Subject::create(['id' => 16, 'title' => 'پرسش']);
    Subject::create(['id' => 17, 'title' => 'جنسیت']);
    Subject::create(['id' => 18, 'title' => 'ورزش']);
    Subject::create(['id' => 19, 'title' => 'بازی']);
    Subject::create(['id' => 20, 'title' => 'موسیقی']);
    Subject::create(['id' => 21, 'title' => 'نوازندگی']);
    Subject::create(['id' => 22, 'title' => 'نقاشی']);
    Subject::create(['id' => 23, 'title' => 'ماشین']);
    Subject::create(['id' => 24, 'title' => 'دوچرخه']);
    Subject::create(['id' => 25, 'title' => 'مدیریت']);
    Subject::create(['id' => 26, 'title' => 'تبلیغات']);
    Subject::create(['id' => 27, 'title' => 'کار']);
    Subject::create(['id' => 28, 'title' => 'تعمیرات']);
    Subject::create(['id' => 29, 'title' => 'مهاجرت']);
    Subject::create(['id' => 30, 'title' => 'جنگ']);
    Subject::create(['id' => 31, 'title' => 'مذهب']);
    Subject::create(['id' => 32, 'title' => 'موافقت']);
    Subject::create(['id' => 33, 'title' => 'مخالفت']);
    Subject::create(['id' => 34, 'title' => 'طبیعت']);
    Subject::create(['id' => 35, 'title' => 'اجتماعی']);
    Subject::create(['id' => 36, 'title' => 'اقتصادی']);
    Subject::create(['id' => 37, 'title' => 'علمی']);
    Subject::create(['id' => 38, 'title' => 'خودمونی']);
    Subject::create(['id' => 39, 'title' => 'رسمی']);
    Subject::create(['id' => 40, 'title' => 'حیوانات']);
    Subject::create(['id' => 41, 'title' => 'آب و هوا']);
    Subject::create(['id' => 42, 'title' => 'دانشگاه']);
    Subject::create(['id' => 43, 'title' => 'فوتبال']);
    Subject::create(['id' => 44, 'title' => 'خسیس']);
    Subject::create(['id' => 45, 'title' => 'موبایل']);
    Subject::create(['id' => 46, 'title' => 'خانواده']);
  }
}
