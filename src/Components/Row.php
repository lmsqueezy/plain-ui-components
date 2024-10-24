<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;
use LogicException;

class Row implements ContainerComponent
{
    /**
     * An array of row main components.
     */
    protected array $mainContent = [];

    /**
     * An array of row aside components.
     */
    protected array $asideContent = [];

    /**
     * Create a new row component instance.
     */
    public function __construct(?RowComponent $main = null, ?RowComponent $aside = null)
    {
        if ($main) {
            $this->addMain($main);
        }

        if ($aside) {
            $this->addAside($aside);
        }
    }

    /**
     * Fluently create a new row component instance.
     */
    public static function make(?RowComponent $main = null, ?RowComponent $aside = null): static
    {
        return new static($main, $aside);
    }

    /**
     * Add a component to the main content.
     *
     * @return $this
     */
    public function addMain(RowComponent $component): static
    {
        $this->mainContent[] = $component;

        return $this;
    }

    /**
     * Add a component to the aside content.
     *
     * @return $this
     */
    public function addAside(RowComponent $component): static
    {
        $this->asideContent[] = $component;

        return $this;
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        if (count($this->mainContent) === 0) {
            throw new LogicException('Row should contain at least one main component.');
        }

        if (count($this->asideContent) === 0) {
            throw new LogicException('Row should contain at least one aside component.');
        }

        return [
            'componentRow' => [
                'rowMainContent' => array_map(
                    static fn (RowComponent $component) => $component->toArray(),
                    $this->mainContent
                ),
                'rowAsideContent' => array_map(
                    static fn (RowComponent $component) => $component->toArray(),
                    $this->asideContent
                ),
            ],
        ];
    }
}
