<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
  protected $primary = 'id';
  protected $table = 'documents';
  protected $fillable = ['text', 'subject_id'];

  public function subject() {
    return $this->belongsTo(Subject::class, 'subject_id');
  }
}
