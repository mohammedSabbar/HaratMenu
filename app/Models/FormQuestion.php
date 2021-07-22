<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQuestion extends Model
{
    protected $table = 'form_question';
    use HasFactory;

        public function question(){
        return $this->belongsTo(Question::class);
    }
}
