# Plain UI Components

<p>
    <a href="https://github.com/lmsqueezy/plain-ui-components/actions"><img src="https://github.com/lmsqueezy/plain-ui-components/actions/workflows/tests.yml/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/lmsqueezy/plain-ui-components"><img src="https://img.shields.io/packagist/dt/lmsqueezy/plain-ui-components" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/lmsqueezy/plain-ui-components"><img src="https://img.shields.io/packagist/v/lmsqueezy/plain-ui-components" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/lmsqueezy/plain-ui-components"><img src="https://img.shields.io/packagist/l/lmsqueezy/plain-ui-components" alt="License"></a>
</p>

A Laravel-based library to easily build [Plain UI component](https://docs.plain.com/adding-context/ui-components) cards.

## Requirements

- PHP 8.1 or higher
- Laravel 10.0 or higher

## Installation

Install the package with composer:

```bash
composer require lemonsqueezy/plain-ui-components
```

## Usage

```php
/**
 * An Plain Customer Card endpoint
 *
 * @link https://docs.plain.com/adding-context/customer-cards
 */
public function customerCards(Request $request)
{
    abort_unless($email = $request->input('customer.email'), 400, 'No email provided.');

    $user = User::where('email', $email)->firstOrFail();

    return Cards::make()
        // Adding a card directly is easy, but the data is not guaranteed to be used by Plain.
        ->add(Card::make('platform-details')->add(Text::make('Platform Version: '.config('app.version')))

        // As an alternative, you can therefore use a binding, which lazily resolves
        // only when the request asks for that card, making it way more efficient.
        ->bind('user-details', fn (Card $card) => $this->buildUserDetailsCard($card, $user))

        // Finally, we'll render the cards payload using the JSON Request made by Plain.        
        ->toArray($request);
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hello@lemonsqueezy.com instead of using the issue tracker.

This way, we can safely discuss and resolve the issue (within a reasonable timeframe), without exposing users to the unnecessary additional risk.
Once the issue is fixed and a new version is released, we'll make sure to credit you for your contribution (unless you wish to remain anonymous).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
