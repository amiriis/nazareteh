<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptiveAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptive_answers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('sheet_id')
                  ->constrained('sheets');
            $table->foreignId('question_id')
                  ->constrained('questions');
            $table->text('answer');
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
        Schema::dropIfExists('descriptive_answers');
    }
}
