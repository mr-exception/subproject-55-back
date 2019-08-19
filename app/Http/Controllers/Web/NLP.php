<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Subject;
use Illuminate\Http\Request;
use NlpTools\Classifiers\MultinomialNBClassifier;
use NlpTools\Documents\TokensDocument;
use NlpTools\Documents\TrainingSet;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Tokenizers\WhitespaceTokenizer;

class Nlp extends Controller {
  public function learn(Request $request, $screen_name, $step = 0) {
    $tweet = $request->session()->get("fetched_users.$screen_name.tweets.$step");
    // dd($tweet);
    return view('learn.tweet', ['tweet' => $tweet, 'screen_name' => $screen_name, 'step' => $step]);
  }
  public function storeLearn(Request $request) {
    $obs = ['/@.*/i', '/RT/i', '/\t/i', '/\n/i'];
    foreach ($request->input('subject', []) as $subject_id => $value) {
      $text = $request->input('text', '');
      foreach ($obs as $ob) {
        $text = preg_replace($ob, '', $text);
      }
      Document::create([
        'subject_id' => $subject_id,
        'text' => $request->input('text', ''),
      ]);
    }
    return redirect()->route('web.learn', ['screen_name' => $request->screen_name, 'step' => $request->step + 1]);
  }
  public function test(Request $request) {
    $screen_name = $request->input('screen_name');
    $tweets = session("fetched_users.$screen_name.tweets");

    $tset = new TrainingSet();
    $tok = new WhitespaceTokenizer();
    $ff = new DataAsFeatures();

    // ---------- Training ----------------
    foreach (Document::all() as $document) {
      $tset->addDocument(
        $document->subject_id,
        new TokensDocument(
          $tok->tokenize($document->text)
        )
      );
    }
    $model = new FeatureBasedNB();
    $model->train($ff, $tset);
    // ---------- Classification ----------------
    $cls = new MultinomialNBClassifier($ff, $model);
    $results = [];

    foreach ($tweets as $tweet) {
      $result = [];
      foreach (Subject::all() as $subject) {
        $prediction = $cls->getScore($subject->id, new TokensDocument($tok->tokenize($tweet->full_text)));
        $result[$subject->id] = $prediction;
      }
      asort($result, SORT_NUMERIC);
      foreach ($result as $key => $value) {
        if (sizeof($result) > 5) {
          unset($result[$key]);
        }
      }
      array_push($results, $result);
    }
    dd($results);
  }
}
