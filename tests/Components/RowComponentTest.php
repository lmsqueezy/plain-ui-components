<?php

namespace LemonSqueezy\PlainUiComponents\Tests\Components;

use LemonSqueezy\PlainUiComponents\Components\Badge;
use LemonSqueezy\PlainUiComponents\Components\CopyButton;
use LemonSqueezy\PlainUiComponents\Components\Divider;
use LemonSqueezy\PlainUiComponents\Components\LinkButton;
use LemonSqueezy\PlainUiComponents\Components\PlainText;
use LemonSqueezy\PlainUiComponents\Components\Row;
use LemonSqueezy\PlainUiComponents\Components\Spacer;
use LemonSqueezy\PlainUiComponents\Components\Text;
use LemonSqueezy\PlainUiComponents\Tests\TestCase;
use LogicException;

class RowComponentTest extends TestCase
{
    /** @test */
    public function the_row_must_contain_at_least_one_main_component(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Row should contain at least one main component.');

        Row::make()->toArray();
    }

    /** @test */
    public function the_row_cannot_only_have_main_components(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Row should contain at least one aside component.');

        Row::make()->addMain(Text::make('Hello world'))->toArray();
    }

    /** @test */
    public function the_row_can_have_aside_components(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentDivider' => [
                                'dividerSpacingSize' => 'S',
                            ],
                        ],
                    ],
                    'rowAsideContent' => [
                        [
                            'componentText' => [
                                'text' => 'Hello world',
                            ],
                        ],
                        [
                            'componentBadge' => [
                                'badgeLabel' => 'Badge',
                                'badgeColor' => 'GREY',
                            ],
                        ],
                    ],
                ],
            ],
            Row::make()
                ->addMain(Divider::make())
                ->addAside(Text::make('Hello world'))
                ->addAside(Badge::make('Badge'))
                ->toArray()
        );
    }

    /** @test */
    public function the_row_cannot_only_have_aside_components(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Row should contain at least one main component.');

        Row::make()->addAside(Text::make('Hello world'))->toArray();
    }

    /** @test */
    public function the_row_can_contain_a_badge(): void
    {
        $this->assertSame(
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
            Row::make()
                ->addMain(Badge::make('Hello world'))
                ->addAside(Divider::make())
                ->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_a_multiple_main_components(): void
    {
        $this->assertSame(
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
            Row::make(
                Badge::make('Hello world'),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_a_copy_button(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentCopyButton' => [
                                'copyButtonValue' => 'Hello world',
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
            Row::make(
                CopyButton::make('Hello world'),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_a_divider(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentDivider' => [
                                'dividerSpacingSize' => 'S',
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
            Row::make(
                Divider::make(),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_a_link_button(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentLinkButton' => [
                                'linkButtonLabel' => 'Track order',
                                'linkButtonUrl' => 'https://plain.com',
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
            Row::make(
                LinkButton::make('Track order', 'https://plain.com'),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_a_spacer(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentSpacer' => [
                                'spacerSize' => 'S',
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
            Row::make(
                Spacer::make(),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_text(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentText' => [
                                'text' => '123 Example Street, Fakerton, FA6 4UX, Hertfordshire, UK',
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
            Row::make(
                Text::make('123 Example Street, Fakerton, FA6 4UX, Hertfordshire, UK'),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_can_contain_plaintext(): void
    {
        $this->assertSame(
            [
                'componentRow' => [
                    'rowMainContent' => [
                        [
                            'componentPlainText' => [
                                'plainText' => 'Shipping address',
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
            Row::make(
                PlainText::make('Shipping address'),
                Divider::make()
            )->toArray()
        );
    }

    /** @test */
    public function the_row_cannot_contain_a_row(): void
    {
        $this->expectException(\TypeError::class);

        Row::make()->addMain(Row::make());
    }
}
