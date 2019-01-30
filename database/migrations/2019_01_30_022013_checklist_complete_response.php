<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChecklistCompleteResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('checklist_complete_response');
        Schema::create('checklist_complete_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->boolean('is_completed');
            $table->string('checklist_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('checklist_complete_response');
    }
}
