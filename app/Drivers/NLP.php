<?php

namespace App\Drivers;

use App\Models\Document;
use App\Models\Subject;
use NlpTools\Classifiers\MultinomialNBClassifier;
use NlpTools\Documents\TokensDocument;
use NlpTools\Documents\TrainingSet;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Tokenizers\WhitespaceTokenizer;

class NLP {
  public static function getScores($text) {
    $model = NLP::generateModel();
    $ff = new DataAsFeatures();
    $tok = new WhitespaceTokenizer();
    $cls = new MultinomialNBClassifier($ff, $model);
    $result = [];
    foreach (Subject::all() as $subject) {
      $prediction = $cls->getScore($subject->id, new TokensDocument($tok->tokenize($text)));
      $result[$subject->id] = $prediction;
    }
    asort($result, SORT_NUMERIC);
    foreach ($result as $key => $value) {
      if (sizeof($result) > 5) {
        unset($result[$key]);
      }
    }
    return $result;
  }
  public static function generateModel() {
    if (file_exists('./model.db')) {
      $model = unserialize(file_get_contents('./model.db'));
      return $model;
    }
    $tset = new TrainingSet();
    $tok = new WhitespaceTokenizer();
    $ff = new DataAsFeatures();

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
    $serialized = serialize($model);
    file_put_contents('./model.db', $serialized);
    return $model;
  }
}