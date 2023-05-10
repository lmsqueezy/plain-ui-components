<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LemonSqueezy\PlainUiComponents\Components\Divider;
use LemonSqueezy\PlainUiComponents\Enums\DividerSize;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;

class DividerTest extends TestCase
{
    /** @test */
    public function the_divider_is_arrayable(): void
    {
        $this->assertSame(
            [
                'componentDivider' => [
                    'dividerSpacingSize' => 'S',
                ],
            ],
            Divider::make()->toArray()
        );
    }

    /** @test */
    public function the_divider_size_can_be_customized(): void
    {
        $this->assertSame(
            [
                'componentDivider' => [
                    'dividerSpacingSize' => 'L',
                ],
            ],
            Divider::make(DividerSize::L)->toArray()
        );
    }
}
