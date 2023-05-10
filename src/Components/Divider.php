<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;
use LemonSqueezy\PlainUiComponents\Enums\DividerSize;

class Divider implements ContainerComponent, RowComponent
{
    /**
     * The spacing the divider should have before and after the component.
     */
    protected DividerSize $size;

    /**
     * Create a new divider component instance.
     */
    protected function __construct(DividerSize $size = DividerSize::S)
    {
        $this->size = $size;
    }

    /**
     * Fluently create a new divider component instance.
     */
    public static function make(DividerSize $size = DividerSize::S): static
    {
        return new static($size);
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        return [
            'componentDivider' => [
                'dividerSpacingSize' => $this->size->value,
            ],
        ];
    }
}
