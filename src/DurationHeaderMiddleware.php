<?php

namespace BenTools\GuzzleHttp\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DurationHeaderMiddleware
{
    /**
     * @var string
     */
    private $headerName;

    /**
     * DurationHeaderMiddleware constructor.
     * @param string $headerName
     */
    public function __construct($headerName = 'X-Request-Duration')
    {
        $this->headerName = $headerName;
    }

    /**
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $start = microtime(true);
            $promise = $handler($request, $options);
            return $promise->then($this->handleResponse($start));
        };
    }

    /**
     * @param float $start
     * @return \Closure
     */
    private function handleResponse($start)
    {
        return function (ResponseInterface $response) use ($start) {
            $duration = round(microtime(true) - $start, 3);
            return $response->withHeader($this->headerName, $duration);
        };
    }
}
