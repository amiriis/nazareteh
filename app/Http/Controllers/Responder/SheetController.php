<?php

namespace App\Http\Controllers\Responder;

use App\Http\Controllers\Controller;
use App\Models\Sheet;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function index(Sheet $sheet){
        return $sheet;
    }
}
