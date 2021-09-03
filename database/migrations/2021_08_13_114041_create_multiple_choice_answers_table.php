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
            $table->foreignId('responder_id')
                ->constrained('responders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('sheet_id')
                ->constrained('sheets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('question_id')
                ->constrained('questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('choice_id')
                ->constrained('choices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
