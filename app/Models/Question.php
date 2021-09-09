<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $appends = array('choice_count');

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

    public function getChoiceCountAttribute()
    {
        return $this->choices->count();
    }

    public function getTypeFaAttribute()
    {
        $text = '';

        if ($this->has_choice && $this->has_multiple_choice && $this->has_descriptive)
            $text = 'تشریحی + انتخابی';
        elseif ($this->has_choice && $this->has_descriptive)
            $text = 'تشریحی + گزینه ای';
        elseif ($this->has_choice && $this->has_multiple_choice)
            $text = 'انتخابی';
        elseif ($this->has_choice)
            $text = 'گزینه ای';
        elseif ($this->has_descriptive)
            $text = 'تشریحی';

        return $text;
    }
}
