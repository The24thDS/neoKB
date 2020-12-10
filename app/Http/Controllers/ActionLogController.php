<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $actionLogs = ActionLog::paginate();

    return view('admin.action-logs', compact('actionLogs'));
  }
}
