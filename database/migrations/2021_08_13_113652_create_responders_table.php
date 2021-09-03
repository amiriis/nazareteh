<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responders', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->foreignId('sheet_id')
                ->constrained('sheets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('status');
            $table->uuid('token')->nullable();
            $table->dateTime('answer_at')->nullable();
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
        Schema::dropIfExists('responders');
    }
}
