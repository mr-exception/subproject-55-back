<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
  protected $primary = 'id';
  protected $table = 'subjects';
  protected $fillable = ['title', 'documents_count'];

  public function tokens() {
    return $this->hasMany(Token::class, 'subject_id');
  }
}
