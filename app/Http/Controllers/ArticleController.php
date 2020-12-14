<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\Domain;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $domains = Domain::all()->mapWithKeys(fn ($domain) => [$domain->name => $domain->id]);
    return view('article.create', compact('domains'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  CreateArticleRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateArticleRequest $request)
  {
    $data = $request->validated();
    $article = new Article([
      'title' => $data['title'],
      'content' => $data['content'],
    ]);
    $article->user_id = auth()->user()->id;
    $article->save();
    $article->domains()->attach($data['domains']);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function edit(Article $article)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article)
  {
    //
  }
}
