<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_options', function (Blueprint $table) {
            $table->increments('id');

            $table->text('value');
            $table->integer('plan_id')->unsigned();
            $table->integer('position')->unsigned()->nullable()->comment('priority: min -> max');
            $table->tinyInteger('is_active')->default(1)->comment('1: Enable, 0: Disable');

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
        Schema::dropIfExists('plan_options');
    }
}
