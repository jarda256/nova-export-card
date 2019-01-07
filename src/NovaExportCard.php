<?php

namespace jarda256\NovaExportCard;

use Laravel\Nova\Card;

class NovaExportCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/6';

    public function __construct($resource)
    {
        parent::__construct();
        $this->withMeta([
            'resourceLabel' => $resource::label(),
            'resource' => $resource::uriKey(),
        ]);
    }


    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'export-card';
    }
}
