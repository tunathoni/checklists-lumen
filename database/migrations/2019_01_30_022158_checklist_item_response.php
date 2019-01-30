<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChecklistItemResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('checklist_item_response', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('type');
        //     $table->string('attributes_object_domain');
        //     $table->string('attributes_object_id');
        //     $table->string('attributes_description');
        //     $table->boolean('attributes_is_completed');
        //     $table->string('attributes_completed_at')->nullable();
        //     $table->string('attributes_last_update_by')->nullable();
        //     $table->timestamp('attributes_update_at')->nullable();
        //     $table->timestamp('attributes_created_at');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
