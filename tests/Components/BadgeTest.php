<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LemonSqueezy\PlainUiComponents\Components\Badge;
use LemonSqueezy\PlainUiComponents\Enums\BadgeColor;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;

class BadgeTest extends TestCase
{
    /** @test */
    public function the_badge_is_arrayable(): void
    {
        $this->assertSame(
            [
                'componentBadge' => [
                    'badgeLabel' => 'Hello world',
                    'badgeColor' => 'GREY',
                ],
            ],
            Badge::make('Hello world')->toArray()
        );
    }

    /** @test */
    public function the_badge_color_can_be_customized(): void
    {
        $this->assertSame(
            [
                'componentBadge' => [
                    'badgeLabel' => 'Hello world',
                    'badgeColor' => 'BLUE',
                ],
            ],
            Badge::make('Hello world', BadgeColor::BLUE)->toArray()
        );
    }
}
