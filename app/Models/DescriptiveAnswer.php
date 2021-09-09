<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptiveAnswer extends Model
{
    use HasFactory;

    public function responer()
    {
        return $this->belongsTo(Responder::class, 'responder_id');
    }
}
