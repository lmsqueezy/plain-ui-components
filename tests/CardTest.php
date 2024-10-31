<?php

namespace LemonSqueezy\PlainUiComponents\Tests;

use LemonSqueezy\PlainUiComponents\Card;
use LemonSqueezy\PlainUiComponents\Components\Badge;
use LemonSqueezy\PlainUiComponents\Components\Container;
use LemonSqueezy\PlainUiComponents\Components\CopyButton;
use LemonSqueezy\PlainUiComponents\Components\Divider;
use LemonSqueezy\PlainUiComponents\Components\LinkButton;
use LemonSqueezy\PlainUiComponents\Components\PlainText;
use LemonSqueezy\PlainUiComponents\Components\Row;
use LemonSqueezy\PlainUiComponents\Components\Spacer;
use LemonSqueezy\PlainUiComponents\Components\Text;

class CardTest extends TestCase
{
    /** @test */
    public function the_card_is_arrayable(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [],
            ],
            Card::make('card-key')->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_badge(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentBadge' => [
                            'badgeLabel' => 'Hello world',
                            'badgeColor' => 'GREY',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(Badge::make('Hello world'))->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_multiple_components(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentBadge' => [
                            'badgeLabel' => 'Hello world',
                            'badgeColor' => 'GREY',
                        ],
                    ],
                    [
                        'componentBadge' => [
                            'badgeLabel' => 'Hello again',
                            'badgeColor' => 'GREY',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')
                ->add(Badge::make('Hello world'))
                ->add(Badge::make('Hello again'))
                ->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_container(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentContainer' => [
                            'containerContent' => [
                                [
                                    'componentBadge' => [
                                        'badgeLabel' => 'Hello world',
                                        'badgeColor' => 'GREY',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(
                Container::make()->add(Badge::make('Hello world'))
            )->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_copy_button(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentCopyButton' => [
                            'copyButtonValue' => 'Hello world',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(CopyButton::make('Hello world'))->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_divider(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentDivider' => [
                            'dividerSpacingSize' => 'S',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(Divider::make())->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_link_button(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentLinkButton' => [
                            'linkButtonLabel' => 'Track order',
                            'linkButtonUrl' => 'https://plain.com',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(LinkButton::make('Track order', 'https://plain.com'))->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_row(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentRow' => [
                            'rowMainContent' => [
                                [
                                    'componentBadge' => [
                                        'badgeLabel' => 'Hello world',
                                        'badgeColor' => 'GREY',
                                    ],
                                ],
                            ],
                            'rowAsideContent' => [
                                [
                                    'componentDivider' => [
                                        'dividerSpacingSize' => 'S',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(
                Row::make(
                    Badge::make('Hello world'),
                    Divider::make()
                )
            )->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_a_spacer(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentSpacer' => [
                            'spacerSize' => 'S',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(
                Spacer::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_text(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentText' => [
                            'text' => 'Shipping address',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(
                Text::make('Shipping address')
            )->toArray()
        );
    }

    /** @test */
    public function the_card_can_contain_plaintext(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentPlainText' => [
                            'plainText' => 'Shipping address',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')->add(
                PlainText::make('Shipping address')
            )->toArray()
        );
    }

    /** @test */
    public function the_card_can_conditionally_add_components(): void
    {
        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                    [
                        'componentText' => [
                            'text' => 'Hello world',
                        ],
                    ],
                ],
            ],
            Card::make('card-key')
                ->when(true, fn (Card $card) => $card->add(Text::make('Hello world')))
                ->toArray()
        );

        $this->assertSame(
            [
                'key' => 'card-key',
                'timeToLiveSeconds' => null,
                'components' => [
                ],
            ],
            Card::make('card-key')
                ->when(false, fn (Card $card) => $card->add(Text::make('Hello world')))
                ->toArray()
        );
    }
}
