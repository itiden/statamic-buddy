<?php

namespace Itiden\StatamicBuddy\Http\Controllers;

use Statamic\Http\Controllers\Controller;

class DeployLogController extends Controller
{
  public function __invoke()
  {
    return view('statamic-buddy::log');
  }
}
