<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class Responder extends Model
{
    use HasFactory;

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }

    public function descriptiveAnswers()
    {
        return $this->hasMany(DescriptiveAnswer::class);
    }

    public function getAnswerAtFaAttribute()
    {
        if ($this->answer_at == null)
            return '-';
        return CalendarUtils::strftime('H:i Y/m/d', strtotime($this->answer_at));
    }
}
