<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('action_logs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('model_id');
      $table->string('model_type');
      $table->unsignedBigInteger('user_id')->nullable();
      $table->string('type');
      $table->text('before_attributes');
      $table->text('after_attributes');
      $table->timestamps();

      $table->index('user_id');
      $table->index('type');
      $table->index('model_id');
      $table->index('model_type');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('action_logs');
  }
}
