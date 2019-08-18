<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model {
  protected $primary = 'id';
  protected $table = 'tokens';
  protected $fillable = ['title', 'subject_id', 'score'];

  public function subject(){
    return $this->belongsTo(Subject::class, 'subject_id');
  }
}
