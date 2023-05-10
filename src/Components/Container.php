<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LogicException;
use LemonSqueezy\PlainUiComponents\Contracts\Component;
use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;

class Container implements Component
{
    /**
     * An array of container components.
     */
    protected array $content = [];

    /**
     * Fluently create a new container component instance.
     */
    public static function make(): static
    {
        return new static();
    }

    /**
     * Add a component to the container.
     *
     * @return $this
     */
    public function add(ContainerComponent $component): static
    {
        $this->content[] = $component;

        return $this;
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        if (count($this->content) === 0) {
            throw new LogicException('Container should contain at least one component.');
        }

        return [
            'componentContainer' => [
                'containerContent' => array_map(
                    static fn (ContainerComponent $component) => $component->toArray(),
                    $this->content
                ),
            ],
        ];
    }
}
