<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LogicException;
use LemonSqueezy\PlainUiComponents\Components\Badge;
use LemonSqueezy\PlainUiComponents\Components\Container;
use LemonSqueezy\PlainUiComponents\Components\CopyButton;
use LemonSqueezy\PlainUiComponents\Components\Divider;
use LemonSqueezy\PlainUiComponents\Components\LinkButton;
use LemonSqueezy\PlainUiComponents\Components\PlainText;
use LemonSqueezy\PlainUiComponents\Components\Row;
use LemonSqueezy\PlainUiComponents\Components\Spacer;
use LemonSqueezy\PlainUiComponents\Components\Text;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;

class ContainerTest extends TestCase
{
    /** @test */
    public function the_container_must_contain_at_least_one_component(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Container should contain at least one component.');

        Container::make()->toArray();
    }

    /** @test */
    public function the_container_can_contain_a_badge(): void
    {
        $this->assertSame(
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
            Container::make()->add(Badge::make('Hello world'))->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_multiple_components(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
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
            ],
            Container::make()
                ->add(Badge::make('Hello world'))
                ->add(Badge::make('Hello again'))
                ->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_a_copy_button(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
                        [
                            'componentCopyButton' => [
                                'copyButtonValue' => 'Hello world',
                            ],
                        ],
                    ],
                ],
            ],
            Container::make()->add(CopyButton::make('Hello world'))->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_a_divider(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
                        [
                            'componentDivider' => [
                                'dividerSpacingSize' => 'S',
                            ],
                        ],
                    ],
                ],
            ],
            Container::make()->add(Divider::make())->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_a_link_button(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
                        [
                            'componentLinkButton' => [
                                'linkButtonLabel' => 'Track order',
                                'linkButtonUrl' => 'https://plain.com',
                            ],
                        ],
                    ],
                ],
            ],
            Container::make()->add(LinkButton::make('Track order', 'https://plain.com'))->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_a_row(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
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
            ],
            Container::make()->add(
                Row::make(
                    Badge::make('Hello world'),
                    Divider::make()
                )
            )->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_a_spacer(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
                        [
                            'componentSpacer' => [
                                'spacerSize' => 'S',
                            ],
                        ],
                    ],
                ],
            ],
            Container::make()->add(
                Spacer::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_text(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
                        [
                            'componentText' => [
                                'text' => 'Shipping address',
                            ],
                        ],
                    ],
                ],
            ],
            Container::make()->add(
                Text::make('Shipping address')
            )->toArray()
        );
    }

    /** @test */
    public function the_container_can_contain_plaintext(): void
    {
        $this->assertSame(
            [
                'componentContainer' => [
                    'containerContent' => [
                        [
                            'componentPlainText' => [
                                'plainText' => 'Shipping address',
                            ],
                        ],
                    ],
                ],
            ],
            Container::make()->add(
                PlainText::make('Shipping address')
            )->toArray()
        );
    }
}
