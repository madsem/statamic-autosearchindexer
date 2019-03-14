<?php

namespace Statamic\Addons\AutoSearchIndexer;

use Statamic\API\Search;
use Statamic\Events\Data\EntryDeleted;
use Statamic\Events\Data\EntrySaved;
use Statamic\Extend\Listener;

class AutoSearchIndexerListener extends Listener
{

    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        EntryDeleted::class => 'updateSearchIndex',
        EntrySaved::class   => 'updateSearchIndex',
    ];

    public function updateSearchIndex($event)
    {
        $index = 'collections/' . $event->contextualData()['collection'] ?? false;

        if ($index) {
            Search::update($index);
        }
    }
}
