<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class General extends Controller {
  public function home(Request $request) {
    return view('welcome');
  }
  public function search(Request $request) {
    $screen_name = $request->input('screen_name', '');
    $person = Person::where('screen_name', 'LIKE', '%' . $screen_name . '%')->first();
    if ($person) {
      return view('show.person', ['person' => $person]);
    } else {
      return redirect()->back()->with(['failed' => 'user not found!']);
    }
  }
}
