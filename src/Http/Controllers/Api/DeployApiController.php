<?php

namespace Itiden\StatamicBuddy\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Statamic\Http\Controllers\Controller;

class DeployApiController extends Controller
{
  public function __invoke(Request $request)
  {
    $response = $this->deploy($request->get('comment', ''));

    return response()->json($response->json());
  }

  private function deploy(string $comment)
  {
    $token = config('statamic-buddy.token');
    $workspace = config('statamic-buddy.workspace');
    $project = config('statamic-buddy.project');
    $pipelineId = config('statamic-buddy.pipeline');

    $response = Http::withToken($token)
      ->post("https://api.buddy.works/workspaces/$workspace/projects/$project/pipelines/$pipelineId/executions", [
          "to_revision" => [
              "revision" => "HEAD"
          ],
          "comment" => $comment
      ]);

    Cache::forget('buddy-deploy-api');

    return $response;
  }
}
