<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;
use LemonSqueezy\PlainUiComponents\Enums\BadgeColor;

class Badge implements ContainerComponent, RowComponent
{
    /**
     * The text that should be displayed on the badge.
     */
    protected string $text;

    /**
     * The color of the badge.
     */
    protected BadgeColor $color;

    /**
     * Create a new badge component instance.
     */
    protected function __construct(string $text, BadgeColor $color = BadgeColor::GREY)
    {
        $this->text = $text;
        $this->color = $color;
    }

    /**
     * Fluently create a new badge component instance.
     */
    public static function make(string $text, BadgeColor $color = BadgeColor::GREY): static
    {
        return new static($text, $color);
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        return [
            'componentBadge' => [
                'badgeLabel' => $this->text,
                'badgeColor' => $this->color->value,
            ],
        ];
    }
}
