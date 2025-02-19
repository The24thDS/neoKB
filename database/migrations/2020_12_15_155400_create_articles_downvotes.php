<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesDownvotes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('articles_downvotes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('article_id')->references('id')->on('articles')->onDelete('cascade');
      $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
      $table->unique(array('article_id', 'user_id'));
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('articles_downvotes');
  }
}
