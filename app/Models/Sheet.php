<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
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

    public function responders()
    {
        return $this->hasMany(Responder::class);
    }

    public function getCreatedAtFaAttribute()
    {
        return CalendarUtils::strftime('H:i Y/m/d', strtotime($this->created_at));
    }

    public function getStartAtFaAttribute()
    {
        if ($this->start_at == null)
            return '-';
        return CalendarUtils::strftime('H:i Y/m/d', strtotime($this->start_at));
    }

    public function getIsStatedAttribute()
    {
        if ($this->start_at == null)
            return false;

        if ($this->start_at > date("Y-m-d H:i:s"))
            return false;

        return true;
    }

    public function getEndAtFaAttribute()
    {
        if ($this->end_at == null)
            return '-';
        return CalendarUtils::strftime('H:%M Y/m/d', strtotime($this->end_at));
    }

    public function getIsEndedAttribute()
    {
        if ($this->end_at == null)
            return false;

        if ($this->end_at > date("Y-m-d H:i:s"))
            return false;

        return true;
    }

    public function getAllTimeFaAttribute()
    {
        if ($this->end_at == null || $this->start_at == null)
            return false;

        $now = new DateTime("$this->end_at");
        $ref = new DateTime("$this->start_at");
        $diff = $now->diff($ref);

        return sprintf('%d روز ، %d ساعت ، %d دقیقه', $diff->d, $diff->h, $diff->i);
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

    public function getUserTypeFaAttribute()
    {
        $text = '';
        switch ($this->user_type) {
            case '1':
                $text = 'کد ملی';
                break;
            case '2':
                $text = 'شماره همراه';
                break;
            case '3':
                $text = 'پست الکترونیک';
                break;
        }

        return $text;
    }

    public function getUrlAttribute()
    {
        if ($this->token == null)
            return '';
        return url("/r/$this->token");
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
        return $this->questions->where('has_descriptive', 0)->where('has_choice', 1)->where('has_multiple_choice', 0)->count();
    }

    public function getQuestionsMultiChoiceCountAttribute()
    {
        return $this->questions->where('has_descriptive', 0)->where('has_choice', 1)->where('has_multiple_choice', 1)->count();
    }

    public function getQuestionsChoiceAndDescriptiveCountAttribute()
    {
        return $this->questions->where('has_descriptive', 1)->where('has_choice', 1)->where('has_multiple_choice', 0)->count();
    }

    public function getQuestionsMultiChoiceAndDescriptiveCountAttribute()
    {
        return $this->questions->where('has_descriptive', 1)->where('has_choice', 1)->where('has_multiple_choice', 1)->count();
    }
}
