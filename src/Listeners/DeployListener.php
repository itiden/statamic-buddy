<?php

declare(strict_types=1);

namespace Itiden\StatamicBuddy\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;
use Itiden\StatamicBuddy\Actions\DeployAction;
use Statamic\Contracts\Git\ProvidesCommitMessage;
use Statamic\Events\AssetDeleted;
use Statamic\Events\EntryCreated;
use Statamic\Events\EntryDeleted;
use Statamic\Events\EntrySaved;
use Statamic\Events\GlobalSetCreated;
use Statamic\Events\GlobalSetDeleted;
use Statamic\Events\GlobalSetSaved;
use Statamic\Events\TermCreated;
use Statamic\Events\TermDeleted;
use Statamic\Events\TermSaved;

final class DeployListener
{
    public function __construct(
        protected DeployAction $deployAction,
    ) {}

    private function handleEntry($event): void
    {
        if ($event->entry->isDirty() && $event->entry->published()) {
            $this->deployAction->handle(
                'Entry updated or created: ' . $event->entry->id()
            );
            return;
        }

        Log::info('Nothing to deploy');
    }

    public function handleGlobalSet($event): void
    {
        $this->deployAction->handle(
            'Global set updated or created: ' . $event->globals->handle(),
        );
    }

    public function handleTerm($event): void
    {
        $this->deployAction->handle(
            'Term updated or created: ' . $event->term->id()
        );
    }

    private function handleDelete($event): void
    {
        $this->deployAction->handle('Deleted : ' . $event::class);
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(Dispatcher $events)
    {

        $events->listen([EntrySaved::class, EntryCreated::class], $this->handleEntry(...));

        $events->listen([GlobalSetSaved::class, GlobalSetCreated::class], $this->handleGlobalSet(...));

        $events->listen([TermSaved::class, TermCreated::class], $this->handleTerm(...));

        $events->listen([
            EntryDeleted::class,
            GlobalSetDeleted::class,
            TermDeleted::class,
            AssetDeleted::class,
        ], $this->handleDelete(...));
    }
}
