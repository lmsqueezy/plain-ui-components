<?php

namespace LemonSqueezy\PlainUiComponents\Components;

use LemonSqueezy\PlainUiComponents\Contracts\ContainerComponent;
use LemonSqueezy\PlainUiComponents\Contracts\RowComponent;
use LemonSqueezy\PlainUiComponents\Enums\TextColor;
use LemonSqueezy\PlainUiComponents\Enums\TextSize;

class PlainText implements ContainerComponent, RowComponent
{
    /**
     * The text that should be displayed.
     */
    protected string $text;

    /**
     * The size of the text.
     */
    protected TextSize $size;

    /**
     * The color of the text.
     */
    protected TextColor $color;

    /**
     * Create a new plaintext component instance.
     */
    protected function __construct(string $text, TextSize $size = TextSize::M, $color = TextColor::NORMAL)
    {
        $this->text = $text;
        $this->size = $size;
        $this->color($color);
    }

    /**
     * Fluently create a new plaintext component instance.
     */
    public static function make(string $text, TextSize $size = TextSize::M, $color = TextColor::NORMAL): static
    {
        return new static($text, $size, $color);
    }

    /**
     * Set the color of the text.
     *
     * @return $this
     */
    public function color(TextColor $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Convert the component to its array representation.
     */
    public function toArray(): array
    {
        return [
            'componentPlainText' => [
                ...($this->size !== TextSize::M ? ['plainTextSize' => $this->size->value] : []),
                ...($this->color !== TextColor::NORMAL ? ['plainTextColor' => $this->color->value] : []),
                'plainText' => $this->text,
            ],
        ];
    }
}
