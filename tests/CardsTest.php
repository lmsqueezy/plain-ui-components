<?php

namespace LemonSqueezy\PlainUiComponents\Tests;

use Illuminate\Http\Request;
use LemonSqueezy\PlainUiComponents\Card;
use LemonSqueezy\PlainUiComponents\Cards;
use Symfony\Component\HttpFoundation\ParameterBag;

class CardsTest extends TestCase
{
    /** @test */
    public function the_cards_are_arrayable(): void
    {
        $resolved = false;

        $this->assertSame(
            [
                'cards' => [
                    [
                        'key' => 'first-key',
                        'timeToLiveSeconds' => null,
                        'components' => [],
                    ],
                    [
                        'key' => 'second-key',
                        'timeToLiveSeconds' => null,
                        'components' => [],
                    ],
                ],
            ],
            Cards::make()
                ->add(Card::make('first-key'))
                ->bind('second-key', function (Card $card) use (&$resolved) {
                    $resolved = true;

                    return $card;
                })
                ->toArray()
        );

        $this->assertTrue($resolved);
    }

    /** @test */
    public function it_only_resolves_cards_that_are_requested(): void
    {
        $resolved = false;
        $request = Request::createFromGlobals()->setJson(new ParameterBag(['cardKeys' => ['first-key']]));

        $this->assertSame(
            [
                'cards' => [
                    [
                        'key' => 'first-key',
                        'timeToLiveSeconds' => null,
                        'components' => [],
                    ],
                ],
            ],
            Cards::make()
                ->add(Card::make('second-key'))
                ->add(Card::make('first-key'))
                ->bind('excluded-key', function (Card $card) use (&$resolved) {
                    $resolved = true;

                    return $card;
                })
                ->toArray($request)
        );

        $this->assertFalse($resolved);
    }

    /** @test */
    public function the_cards_are_stringable(): void
    {
        $this->assertSame(
            '{"cards":[{"key":"card-key","timeToLiveSeconds":null,"components":[]}]}',
            (string) Cards::make()->add(Card::make('card-key'))
        );
    }
}
