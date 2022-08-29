<?php

namespace Itiden\StatamicBuddy\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Statamic\Http\Controllers\Controller;

class LogApiController extends Controller
{
  public function __invoke()
  {
    $executions = $this->getExecutions();

    $grouped = collect($executions)->groupBy(function ($execution) {
      $date = Carbon::parse($execution['date']);

      if ($this->executionIsInProgress($execution)) {
        return __("In progress");
      }

      if ($date->isToday()) {
        return __("Today");
      }
      if ($date->isYesterday()) {
        return __("Yesterday");
      }

      return $date->format('Y-m-d');
    })->map(fn ($items, $key) => [
        "title" => $key,
        "items" => $items,
    ])->values();

    return response()->json(['logs' => $grouped]);
  }

  private function getExecutions(): array
  {
      return Cache::remember('buddy-deploy-api', 60, function () {
          $token = config('statamic-buddy.token');
          $workspace = config('statamic-buddy.workspace');
          $project = config('statamic-buddy.project');
          $pipelineId = config('statamic-buddy.pipeline');

          $response = Http::withToken($token)
              ->get("https://api.buddy.works/workspaces/$workspace/projects/$project/pipelines/$pipelineId/executions");

          if ($response->status() !== 200) {
              return [];
          }

          $body = $response->json();

          /**
           * Execution
           * - status: SUCCESSFUL, FAILED, INPROGRESS, ENQUEUED, SKIPPED, TERMINATED, NOT_EXECUTED, or INITIAL
           * - start_date
           * - finish_date
           */

          return $this->getExecutionData($body['executions']);
      });
  }

  private function getExecutionData(array $executions): array
  {
    return collect($executions)
      ->map(fn ($execution) => [
        "id" => $execution['id'],
        "date" => $execution['start_date'],
        "time" => Carbon::parse($execution['start_date'])->format('H:m'),
        "status" => $this->getStatus($execution),
        "comment" => $execution['comment']
      ])
      ->toArray();
  }

  private function getStatus(array $execution): string
  {
    if ($execution['status'] === 'SUCCESSFUL') {
      return $execution['status'];
    }

    if ($this->executionIsInProgress($execution)) {
      return "INPROGRESS";
    }

    return "FAILED";
  }

  private function executionIsInProgress($execution): bool
  {
    return collect(['INPROGRESS', 'ENQUEUED'])->contains($execution['status']);
  }
}
