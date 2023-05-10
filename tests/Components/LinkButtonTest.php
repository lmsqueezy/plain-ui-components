<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LemonSqueezy\PlainUiComponents\Components\LinkButton;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;

class LinkButtonTest extends TestCase
{
    /** @test */
    public function the_link_button_is_arrayable(): void
    {
        $this->assertSame(
            [
                'componentLinkButton' => [
                    'linkButtonLabel' => 'Track order',
                    'linkButtonUrl' => 'https://plain.com',
                ],
            ],
            LinkButton::make('Track order', 'https://plain.com')->toArray()
        );
    }
}
