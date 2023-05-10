<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;

class LinkButton implements ContainerComponent, RowComponent
{
    /**
     * The text of the button.
     */
    protected string $label;

    /**
     * The URL the button should open in a new tab.
     */
    protected string $url;

    /**
     * Create a new link button component instance.
     */
    protected function __construct(string $label, string $url)
    {
        $this->label = $label;
        $this->url = $url;
    }

    /**
     * Fluently create a new link button component instance.
     */
    public static function make(string $label, string $url): static
    {
        return new static($label, $url);
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        return [
            'componentLinkButton' => [
                'linkButtonLabel' => $this->label,
                'linkButtonUrl' => $this->url,
            ],
        ];
    }
}
