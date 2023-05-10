<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LemonSqueezy\PlainUiComponents\Components\Badge;
use LemonSqueezy\PlainUiComponents\Components\CopyButton;
use LemonSqueezy\PlainUiComponents\Enums\BadgeColor;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;

class CopyButtonTest extends TestCase
{
    /** @test */
    public function the_copy_button_is_arrayable(): void
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

    /** @test */
    public function the_copy_button_tooltip_label_is_optional(): void
    {
        $this->assertSame(
            [
                'componentCopyButton' => [
                    'copyButtonValue' => '#251-82',
                    'copyButtonTooltipLabel' => 'Copy invoice number',
                ],
            ],
            CopyButton::make('#251-82', 'Copy invoice number')->toArray()
        );
    }
}
