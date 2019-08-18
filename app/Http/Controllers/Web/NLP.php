<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NlpTools\Classifiers\MultinomialNBClassifier;
use NlpTools\Documents\TokensDocument;
use NlpTools\Documents\TrainingSet;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Tokenizers\WhitespaceTokenizer;

class Nlp extends Controller {
  public function learn(Request $request, $screen_name, $step = 0){
    $tweet = $request->session()->get("fetched_users.$screen_name.tweets.$step");
    // dd($tweet);
    return view('learn.tweet', ['tweet' => $tweet]);
  }
  public function test(Request $request) {

    $training = array(
      array('فوتبال', 'دیروز چندتا دختر که می‌خواستن برن آزادی رو گرفتن'),
      array('فوتبال', 'چرا زنان رو به ورزشگاه راه نمی‌دین؟'),
      array('فوتبال', 'قلعه‌نویی مربیگری استقلال رو گرفت'),
      array('سیاست', 'احمدی‌نژاد تپه نریده نذاشته دیگه'),
      array('سیاست', 'رهبر کبیر انقلاب به آمریکا گفت هیچ غلطی نمی‌تونه بکنه'),
      array('سیاست', 'باید اسرائیل تا ۲۵ سال آینده نابود بشه'),
      array('سیاست', 'آیا ندا آقاسلطان خونش پس‌گرفته شد؟'),
      array('سیاست', 'نفت ایران تحریم شد'),
    );
    
    $testing = array(
      array('سیاست', 'ایران دشمنی با آمریکا داره'),
      array('سیاست', 'در ایران دختر نمی‌تونه آواز بخونه'),
      array('سیاست', 'ورود زنان به ورزشگاه همچنان ممنوع هست'),
    );

    $tset = new TrainingSet();
    $tok = new WhitespaceTokenizer();
    $ff = new DataAsFeatures();

// ---------- Training ----------------
    foreach ($training as $d) {
      $tset->addDocument(
        $d[0],
        new TokensDocument(
          $tok->tokenize($d[1])
        )
      );
    }

    $model = new FeatureBasedNB();
    $model->train($ff, $tset);
    // dd($model->condprob);
// ---------- Classification ----------------
    $cls = new MultinomialNBClassifier($ff, $model);
    $correct = 0;
    foreach ($testing as $d) {
      $prediction = $cls->classify(
        array('سیاست', 'فوتبال'),
        new TokensDocument(
          $tok->tokenize($d[1])
        )
      );
      if ($prediction == $d[0]) {
        $correct++;
      }

    }

    printf("Accuracy: %.2f\n", 100 * $correct / count($testing));

  }
}
