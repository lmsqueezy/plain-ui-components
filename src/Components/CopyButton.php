<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;

class CopyButton implements ContainerComponent, RowComponent
{
    /**
     * The value that should be copied to the clipboard.
     */
    protected string $value;

    /**
     * The tooltip that is shown when hovering over the copy button.
     */
    protected ?string $tooltip = null;

    /**
     * Create a new copy button component instance.
     */
    protected function __construct(string $value, ?string $tooltip = null)
    {
        $this->value = $value;
        $this->tooltip = $tooltip;
    }

    /**
     * Fluently create a new copy button component instance.
     */
    public static function make(string $value, ?string $tooltip = null): static
    {
        return new static($value, $tooltip);
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        return [
            'componentCopyButton' => [
                'copyButtonValue' => $this->value,
                ...$this->tooltip ? ['copyButtonTooltipLabel' => $this->tooltip] : [],
            ],
        ];
    }
}
