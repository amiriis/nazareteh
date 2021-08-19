<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function descriptiveAnswers()
    {
        return $this->hasMany(DescriptiveAnswer::class);
    }

    public function multipleChoiceAnswers()
    {
        return $this->hasMany(MultipleChoiceAnswer::class);
    }
}
