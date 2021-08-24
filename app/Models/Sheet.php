<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class Sheet extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtFaAttribute()
    {
        return CalendarUtils::strftime('H:i Y/m/d', strtotime($this->created_at));
    }

    public function getStartDateFaAttribute()
    {
        if ($this->start_date == null)
            return '-';
        return CalendarUtils::strftime('H:i Y/m/d', strtotime($this->start_date));
    }

    public function getIsStatedAttribute()
    {
        if ($this->start_date == null)
            return false;

        if ($this->start_date > date("Y-m-d H:i:s"))
            return false;

        return true;
    }

    public function getEndDateFaAttribute()
    {
        if ($this->end_date == null)
            return '-';
        return CalendarUtils::strftime('H:%M Y/m/d', strtotime($this->end_date));
    }

    public function getIsEndedAttribute()
    {
        if ($this->end_date == null)
            return false;

        if ($this->end_date > date("Y-m-d H:i:s"))
            return false;

        return true;
    }

    public function getStatusFaAttribute()
    {
        $text = '';
        switch ($this->status) {
            case '0':
                $text = 'عدم تایید توسط کارشناس';
                break;
            case '1':
                $text = 'شروع نشده';
                break;
            case '2':
                $text = 'در حال بررسی توسط کارشناس';
                break;
            case '3':
                $text = 'در حال نظرسنجی';
                break;
            case '4':
                $text = 'پایان نظرسنجی';
                break;
        }

        return $text;
    }

    public function getUrlAttribute()
    {
        if ($this->token == null)
            return '';
        return url( "/r/$this->token");
    }

    public function getQuestionsCountAttribute()
    {
        return $this->questions->count();
    }

    public function getQuestionsDescriptiveCountAttribute()
    {
        return $this->questions->where('has_descriptive', 1)->where('has_choice', 0)->count();
    }

    public function getQuestionsChoiceCountAttribute()
    {
        return $this->questions->where('has_descriptive', 0)->where('has_choice', 1)->count();
    }

    public function getQuestionsChoiceAndDescriptiveCountAttribute()
    {
        return $this->questions->where('has_descriptive', 1)->where('has_choice', 1)->count();
    }
}
