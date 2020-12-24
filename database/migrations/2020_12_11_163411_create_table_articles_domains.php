<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableArticlesDomains extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('articles_domains', function (Blueprint $table) {
      $table->id();
      $table->foreignId('article_id')->references('id')->on('articles')->onDelete('cascade');
      $table->foreignId('domain_id')->references('id')->on('domains')->onDelete('cascade');
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
    Schema::dropIfExists('articles_domains');
  }
}
