<?php

namespace App\Http\Controllers\Responder;

use App\Http\Controllers\Controller;
use App\Models\DescriptiveAnswer;
use App\Models\MultipleChoiceAnswer;
use App\Models\Responder;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SheetController extends Controller
{
    public function index(Sheet $sheet)
    {
        if ($sheet->status != 3) abort(404);

        return view('responder.login', ['sheet' => $sheet]);
    }

    public function login(Sheet $sheet, Request $request)
    {
        if ($sheet->status != 3) abort(404);
        if (
            Responder::where('user', $request->user)
            ->where('sheet_id', $sheet->id)
            ->where('status', 1)
            ->count() != 0
        ) return back()->with('error', 'نظر شما قبلا در این نظرسنجی ثبت شده است');

        if (
            Responder::where('user', $request->user)
            ->where('sheet_id', $sheet->id)
            ->where('status', 0)
            ->count() != 0
        ) {

            $responder = Responder::where('user', $request->user)
                ->where('sheet_id', $sheet->id)
                ->where('status', 0)->first();

            return redirect()->route('reponder.show', ['sheet' => $sheet->token, 'responder' => $responder->token]);
        }

        $responder = new Responder();
        $responder->user = $request->user;
        $responder->sheet_id = $sheet->id;
        $responder->status = 0;
        $responder->token = (string) Str::uuid();
        $responder->save();

        return redirect()->route('reponder.show', ['sheet' => $sheet->token, 'responder' => $responder->token]);
    }

    public function show(Sheet $sheet, Responder $responder)
    {
        if ($sheet->status != 3) abort(404);
        if (
            Responder::where('user', $responder->user)
            ->where('sheet_id', $sheet->id)
            ->where('status', 1)
            ->count() != 0
        ) return redirect()->route('reponder.index', ['sheet' => $sheet->token])->with('error', 'نظر شما قبلا در این نظرسنجی ثبت شده است');

        return view('responder.show', ['sheet' => $sheet, 'responder' => $responder]);
    }

    public function store(Sheet $sheet, Responder $responder, Request $request)
    {
        if ($sheet->status != 3) abort(404);
        if (
            Responder::where('user', $responder->user)
            ->where('sheet_id', $sheet->id)
            ->where('status', 1)
            ->count() != 0
        ) return redirect()->route('reponder.index', ['sheet' => $sheet->token])->with('error', 'نظر شما قبلا در این نظرسنجی ثبت شده است');

        if ($request->has('answers')) {
            foreach ($request->answers as $question_id => $answer) {
                if ($request->has("answers.$question_id.description")) {
                    $descriptive_answer = new DescriptiveAnswer();
                    $descriptive_answer->responder_id = $responder->id;
                    $descriptive_answer->sheet_id = $sheet->id;
                    $descriptive_answer->question_id = $question_id;
                    $descriptive_answer->answer = $answer['description'];
                    $descriptive_answer->save();
                }

                if ($request->has("answers.$question_id.choices")) {
                    foreach ($answer['choices'] as $choice_id) {
                        $choiceAnswer = new MultipleChoiceAnswer();
                        $choiceAnswer->responder_id = $responder->id;
                        $choiceAnswer->sheet_id = $sheet->id;
                        $choiceAnswer->question_id = $question_id;
                        $choiceAnswer->choice_id = $choice_id;
                        $choiceAnswer->save();
                    }
                }
            }
            $responder = Responder::find($responder->id);
            $responder->status = 1;
            $responder->answer_at = date("Y-m-d H:i:s");
            $responder->save();
            return redirect()->route('reponder.thanks', ['sheet' => $sheet->token])->with('access', true);
        }

        return redirect()->route('reponder.index', ['sheet' => $sheet->token])->with('error', 'مشکل در ثبت نظر');
    }

    public function thanks(Sheet $sheet, Request $request)
    {
        if ($request->session()->has('access')) {
            return view('responder.thanks', ['sheet' => $sheet]);
        }

        return abort(404);
    }
}
