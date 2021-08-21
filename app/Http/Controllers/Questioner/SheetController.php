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
        $sheets = Auth::user()->sheets;
        return view('questioner.sheets.index', compact('sheets'));
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

        return redirect()->route('questioner.sheets.index')->with('success', 'فرم نظرسنجی با موفقیت ایجاد شد!');
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
        $sheet = Auth::user()->sheets->find($id);
        if (!$sheet) abort(404);

        return view('questioner.sheets.edit', compact('sheet'));
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
        $sheet = Auth::user()->sheets->find($id);
        if (!$sheet) abort(404);


        $sheet->name = $request->name;
        $sheet->description = $request->description;
        $sheet->user_type = $request->user_type;
        $sheet->status = 1;
        $sheet->save();

        if ($request->has('question.delete')) {
            foreach ($request->question['delete'] as  $deleteQuestionId) {
                $question = Question::find($deleteQuestionId);
                $question->delete();
            }
        }

        if ($request->has('question.edit')) {
            foreach ($request->question['edit'] as $key => $value) {
                $question = Question::find($value['id']);
                $question->title = $value['title'];
                $question->description = $value['description'];
                $question->has_choice = ($request->has("question.edit.$key.has_choice")) ? 1 : 0;
                $question->has_multiple_choice = ($request->has("question.edit.$key.has_multiple_choice")) ? 1 : 0;
                $question->has_descriptive = ($request->has("question.edit.$key.has_descriptive")) ? 1 : 0;
                $question->save();

                if (!$request->has("question.edit.$key.has_choice")) {
                    foreach ($question->choices as $deleteChoice) {
                        $choice = Choice::find($deleteChoice->id);
                        $choice->delete();
                    }
                }

                if ($request->has("question.edit.$key.choice.edit")) {
                    foreach ($value['choice']['edit'] as $choiceId => $item) {
                        $choice = Choice::find($choiceId);
                        $choice->title = $item;
                        $choice->save();
                    }
                }

                if ($request->has("question.edit.$key.choice.add")) {
                    foreach ($value['choice']['add'] as $item) {
                        $choice = new Choice;
                        $choice->question_id = $question->id;
                        $choice->title = $item;
                        $choice->save();
                    }
                }
            }
        }

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

        if ($request->has('choices.delete')) {
            foreach ($request->choices['delete'] as  $deleteChoicesId) {
                $choice = Choice::find($deleteChoicesId);
                $choice->delete();
            }
        }

        return redirect()->route('questioner.sheets.index')->with('success', "فرم نظرسنجی $sheet->name با موفقیت ویرایش شد!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sheet = Auth::user()->sheets->find($id);
        if (!$sheet) abort(404);

        $name = $sheet->name;

        $sheet->delete();

        return redirect()->route('questioner.sheets.index')->with('success', "فرم نظرسنجی $name با موفقیت حذف شد!");
    }

    public function start($id)
    {
        $sheet = Auth::user()->sheets->find($id);
        if (!$sheet) abort(404);

        $sheet->status = 3;
        $sheet->start_date = date("Y-m-d H:i:s");
        $sheet->token = $this->createToken($sheet->id);
        $sheet->save();

        return redirect()->route('questioner.sheets.index')->with('success', "شروع  نظرسنجی $sheet->name");
    }

    public function end($id)
    {
        $sheet = Auth::user()->sheets->find($id);
        if (!$sheet) abort(404);

        $sheet->status = 4;
        $sheet->end_date = date("Y-m-d H:i:s");
        $sheet->token = null;
        $sheet->save();

        return redirect()->route('questioner.sheets.index')->with('success', "پایان  نظرسنجی $sheet->name");
    }

    private function createToken($id)
    {
        return $this->generateRandomString() . $id . $this->generateRandomString();
    }

    private function generateRandomString()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 2; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
