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
      return redirect()->route('web.home')->with(['failed' => 'user not found!']);
    }
  }
  public function followers(Request $request, Person $person) {
    $persons = $person->followers()->paginate(10);
    return view('followers', ['persons' => $persons, 'source' => $person]);
  }
  public function followings(Request $request, Person $person){
    $persons = $person->followings()->paginate(10);
    return view('followings', ['persons' => $persons, 'source' => $person]);
  }
}
