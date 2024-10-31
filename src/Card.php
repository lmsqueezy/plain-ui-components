<?php

namespace LemonSqueezy\PlainUiComponents;

use Illuminate\Support\Traits\Conditionable;
use LemonSqueezy\PlainUiComponents\Contracts\Component;

class Card
{
    use Conditionable;

    /**
     * The key of the card.
     */
    protected string $key;

    /**
     * The time to live in seconds.
     */
    protected ?int $ttl;

    /**
     * The components that should be displayed in the card.
     */
    protected array $components = [];

    /**
     * Create a new card instance.
     */
    protected function __construct(string $key, ?int $ttl = null)
    {
        $this->key = $key;
        $this->ttl = $ttl;
    }

    /**
     * Fluently create a new card instance.
     */
    public static function make(string $key, ?int $ttl = null): static
    {
        return new static($key, $ttl);
    }

    /**
     * Add a component to the card.
     *
     * @return $this
     */
    public function add(Component $component): static
    {
        $this->components[] = $component;

        return $this;
    }

    /**
     * Convert the card to its array representation.
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'timeToLiveSeconds' => $this->ttl,
            'components' => array_map(
                static fn (Component $component) => $component->toArray(),
                $this->components
            ),
        ];
    }
}
