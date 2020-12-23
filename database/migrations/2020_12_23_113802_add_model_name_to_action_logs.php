<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelNameToActionLogs extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('action_logs', function (Blueprint $table) {
      $table->string('model_name')->nullable()->after('model_type');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('action_logs', function (Blueprint $table) {
      $table->dropColumn('model_name');
    });
  }
}
