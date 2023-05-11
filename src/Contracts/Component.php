<?php

namespace LemonSqueezy\PlainUiComponents\Contracts;

interface Component
{
    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array;
}
