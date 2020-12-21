<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Domain;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $articles = Article::latest()->paginate(6);

    return view('feed', compact('articles'));
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
      'user_id' => auth()->user()->id,
    ]);
    $article->save();
    $article->domains()->attach($data['domains']);
    $article->searchable();

    return redirect()->route('article.show', ['article' => $article->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article)
  {
    return view('article.show', compact('article'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function edit(Article $article)
  {
    $this->authorize('update', $article);
    $domains = Domain::all()->mapWithKeys(fn ($domain) => [$domain->name => $domain->id]);
    return view('article.edit', compact('article', 'domains'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateArticleRequest $request, Article $article)
  {
    $data = $request->validated();
    $article->fill([
      'title' => $data['title'],
      'content' => $data['content'],
    ]);
    $article->domains()->detach($article->domains);
    $article->domains()->attach($data['domains']);
    $article->save();

    return redirect()->route('article.show', ['article' => $article->id]);
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
