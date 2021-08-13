<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choice_answers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('sheet_id')
                  ->constrained('sheets');
            $table->foreignId('question_id')
                  ->constrained('questions');
            $table->foreignId('choice_id')
                  ->constrained('choices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_choice_answers');
    }
}
