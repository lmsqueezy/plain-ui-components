<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LemonSqueezy\PlainUiComponents\Components\Text;
use LemonSqueezy\PlainUiComponents\Enums\TextColor;
use LemonSqueezy\PlainUiComponents\Enums\TextSize;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;

class TextTest extends TestCase
{
    /** @test */
    public function the_text_is_arrayable(): void
    {
        $this->assertSame(
            [
                'componentText' => [
                    'text' => 'Hello world',
                ],
            ],
            Text::make('Hello world')->toArray()
        );
    }

    /** @test */
    public function the_text_size_can_be_customized(): void
    {
        $this->assertSame(
            [
                'componentText' => [
                    'textSize' => 'L',
                    'text' => 'Hello world',
                ],
            ],
            Text::make('Hello world', TextSize::L)->toArray()
        );
    }

    /** @test */
    public function the_text_color_can_be_customized(): void
    {
        $this->assertSame(
            [
                'componentText' => [
                    'textColor' => 'SUCCESS',
                    'text' => 'Hello world',
                ],
            ],
            Text::make('Hello world', TextSize::M, TextColor::SUCCESS)->toArray()
        );
    }

    /** @test */
    public function the_text_color_can_be_set_fluently(): void
    {
        $this->assertSame(
            [
                'componentText' => [
                    'textColor' => 'ERROR',
                    'text' => 'Hello world',
                ],
            ],
            Text::make('Hello world')->color(TextColor::ERROR)->toArray()
        );
    }
}
