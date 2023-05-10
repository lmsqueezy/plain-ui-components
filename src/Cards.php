<?php

namespace LemonSqueezy\PlainUiComponents;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Stringable;

class Cards implements Stringable
{
    /**
     * The resolved cards that should be used.
     */
    protected Collection $resolved;

    /**
     * The card bindings that are resolveable.
     */
    protected Collection $bindings;

    /**
     * Create a new card collection instance.
     */
    protected function __construct()
    {
        $this->resolved = Collection::make();
        $this->bindings = Collection::make();
    }

    /**
     * Fluently create a new card collection instance.
     */
    public static function make(): static
    {
        return new static();
    }

    /**
     * Add a card instance to the cards collection.
     *
     * @return $this
     */
    public function add(Card $card): static
    {
        $result = $card->toArray();
        $key = $result['key'];

        $this->resolved[$key] = $result;

        return $this;
    }

    /**
     * Register a card resolver binding.
     *
     * @return $this
     */
    public function bind(string $key, callable $resolver): static
    {
        $this->bindings[$key] = fn (): Card => $resolver(Card::make($key));

        return $this;
    }

    /**
     * Resolve the requested cardKeys into an array.
     */
    public function toArray(Request $request = null): array
    {
        $keys = $request?->json('cardKeys');

        if (! is_array($keys) && $keys !== null) {
            throw new InvalidArgumentException('The requested cards must be an array.');
        }

        $resolved = $this->resolved;
        $bindings = $this->bindings;

        if ($keys !== null) {
            $resolved = $resolved->filter(fn ($card, $key) => in_array($key, $keys, true));
            $bindings = $bindings->filter(fn ($resolver, $key) => in_array($key, $keys, true));
        }

        return [
            'cards' => $bindings
                ->filter(fn (callable $callback, string $key) => ! $resolved->keys()->contains($key))
                ->map(fn (callable $callback) => $callback()->toArray())
                ->concat($resolved)
                ->sortBy(fn (array $card) => $card['key'])
                ->values()
                ->toArray(),
        ];
    }

    /**
     * Convert the card collection to its string representation.
     *
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }
}
