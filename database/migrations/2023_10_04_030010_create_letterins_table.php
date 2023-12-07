<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letterins', function (Blueprint $table) {
            $table->id();
            $table->date('letter_date');
            $table->string('letter_no')->nullable();
            $table->string('letter_file')->nullable();
            $table->string('letter_disposisi')->nullable();
            $table->string('regarding');
            $table->string('department');
            $table->string('forward');
            $table->string('pertalian')->nullable();
            $table->string('letter_type');
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
        Schema::dropIfExists('letterins');
    }
}
