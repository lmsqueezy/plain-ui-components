<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;
use LemonSqueezy\PlainUiComponents\Enums\SpacerSize;

class Spacer implements ContainerComponent, RowComponent
{
    /**
     * The size of the spacer.
     */
    protected SpacerSize $size;

    /**
     * Create a new spacer component instance.
     */
    protected function __construct(SpacerSize $size = SpacerSize::S)
    {
        $this->size = $size;
    }

    /**
     * Fluently create a new spacer component instance.
     */
    public static function make(SpacerSize $size = SpacerSize::S): static
    {
        return new static($size);
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        return [
            'componentSpacer' => [
                'spacerSize' => $this->size->value,
            ],
        ];
    }
}
