<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DomainController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $domains = Domain::paginate();

    return view('admin.domains', compact('domains'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255', 'unique:domains,name'],
    ]);

    Domain::create(['name' => $request->name]);

    return Redirect::refresh();
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Domain  $domain
   * @return \Illuminate\Http\Response
   */
  public function show(Domain $domain)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Domain  $domain
   * @return \Illuminate\Http\Response
   */
  public function edit(Domain $domain)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Domain  $domain
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Domain $domain)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Domain  $domain
   * @return \Illuminate\Http\Response
   */
  public function destroy(Domain $domain)
  {
    //
  }
}
