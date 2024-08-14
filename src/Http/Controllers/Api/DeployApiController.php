<?php

namespace Itiden\StatamicBuddy\Http\Controllers\Api;

use Illuminate\Http\Request;
use Itiden\StatamicBuddy\Actions\DeployAction;
use Statamic\Http\Controllers\Controller;

class DeployApiController extends Controller
{
  public function __invoke(Request $request, DeployAction $deployAction)
  {
    $response = $deployAction->handle($request->get('comment', ''));

    return response()->json($response->json());
  }
}
