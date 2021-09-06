<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sheet_id')
                  ->constrained('sheets')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('has_choice');
            $table->boolean('has_multiple_choice');
            $table->boolean('has_descriptive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
