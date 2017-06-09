<?php

namespace BenTools\GuzzleHttp\Middleware\Tests;


use BenTools\GuzzleHttp\Middleware\DurationHeaderMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class DurationHeaderMiddlewareTest extends TestCase
{

    public function testMiddleware()
    {
        $middleware = new DurationHeaderMiddleware($headerName = 'My-Custom-Header');
        $stack = new HandlerStack();
        $stack->setHandler(new MockHandler([
            new Response(),
        ]));
        $stack->push($middleware);
        $client = new Client(['handler' => $stack]);

        $response = $client->get('http://www.example.org');
        $this->assertTrue($response->hasHeader($headerName));
    }

}
