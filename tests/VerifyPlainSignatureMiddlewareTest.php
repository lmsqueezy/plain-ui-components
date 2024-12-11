<?php

namespace LemonSqueezy\PlainUiComponents\Tests;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use LemonSqueezy\PlainUiComponents\VerifyPlainSignatureMiddleware;

class VerifyPlainSignatureMiddlewareTest extends TestCase
{
    /** @test */
    public function it_blocks_the_request_when_the_plain_signature_header_is_not_provided(): void
    {
        Config::set('plain.secret', 'my-plain-secret');

        $called = false;
        Route::middleware(VerifyPlainSignatureMiddleware::class)->post('/', function () use (&$called) {
            $called = true;
        });

        $response = $this->post('/', ['example' => 'content']);

        $this->assertFalse($called);
        $response->assertStatus(400);
    }
    
    /** @test */
    public function it_blocks_the_request_when_the_middleware_is_applied_without_a_secret_being_configured(): void
    {
        Config::set('plain.secret', '');

        $called = false;
        Route::middleware(VerifyPlainSignatureMiddleware::class)->post('/', function () use (&$called) {
            $called = true;
        });

        $response = $this->post('/', ['example' => 'content'], [
            'plain-request-signature' => 'example-signature',
        ]);
        
        $this->assertFalse($called);
        $response->assertStatus(403);
    }
    
    /** @test */
    public function it_blocks_the_request_when_the_plain_signature_header_does_not_match_the_configured_secret(): void
    {
        Config::set('plain.secret', 'my-plain-secret');

        $called = false;
        Route::middleware(VerifyPlainSignatureMiddleware::class)->post('/', function () use (&$called) {
            $called = true;
        });

        $response = $this->post('/', ['example' => 'content'], [
            'plain-request-signature' => 'example-signature',
        ]);

        $this->assertFalse($called);
        $response->assertStatus(403);
    }
    
    /** @test */
    public function it_allows_the_request_when_the_plain_signature_header_matches_the_configured_secret(): void
    {
        Config::set('plain.secret', 'my-plain-secret');

        $called = false;
        Route::middleware(VerifyPlainSignatureMiddleware::class)->post('/', function () use (&$called) {
            $called = true;
        });

        $response = $this->post('/', ['example' => 'content'], [
            'plain-request-signature' => 'e85ab1c2f80714be422adfc9f446f9c48a018c971df12527fba9b2a2819cd17c',
        ]);

        $this->assertTrue($called);
        $response->assertStatus(200);
    }
}
