<?php

namespace Itiden\StatamicBuddy\Actions;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class DeployAction
{
    public function handle(string $comment)
    {
        $host = config('statamic-buddy.host');
        $token = config('statamic-buddy.token');
        $workspace = config('statamic-buddy.workspace');
        $project = config('statamic-buddy.project');
        $pipelineId = config('statamic-buddy.pipeline');

        $response = Http::withToken($token)
            ->post("https://$host/workspaces/$workspace/projects/$project/pipelines/$pipelineId/executions", [
                "to_revision" => [
                    "revision" => "HEAD"
                ],
                "comment" => $comment
            ]);

        Cache::forget('buddy-deploy-api');

        return $response;
    }
}
