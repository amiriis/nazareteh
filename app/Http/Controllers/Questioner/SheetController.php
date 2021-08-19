<?php

namespace App\Http\Controllers\Questioner;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questioner.sheets.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sheet = new Sheet;
        $sheet->user_id = Auth::id();
        $sheet->name = $request->name;
        $sheet->description = $request->description;
        $sheet->user_type = $request->user_type;
        $sheet->status = 1;
        $sheet->save();

        if ($request->has('question.add')) {
            foreach ($request->question['add'] as $key => $value) {
                $question = new Question;
                $question->sheet_id = $sheet->id;
                $question->title = $value['title'];
                $question->description = $value['description'];
                $question->has_choice = ($request->has("question.add.$key.has_choice")) ? 1 : 0;
                $question->has_multiple_choice = ($request->has("question.add.$key.has_multiple_choice")) ? 1 : 0;
                $question->has_descriptive = ($request->has("question.add.$key.has_descriptive")) ? 1 : 0;
                $question->save();

                if ($request->has("question.add.$key.choice.add")) {
                    foreach ($value['choice']['add'] as $item) {
                        $choice = new Choice;
                        $choice->question_id = $question->id;
                        $choice->title = $item;
                        $choice->save();
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
