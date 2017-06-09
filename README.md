This package is a middleware for GuzzleHttp 6+ that helps you monitor the time between requests and responses.

Usage
-----

```php
require_once __DIR__ . '/vendor/autoload.php';

use BenTools\GuzzleHttp\Middleware\DurationHeaderMiddleware;
use GuzzleHttp\Client;

$client = new Client();
$middleware = new DurationHeaderMiddleware($headerName = 'X-Request-Duration'); // header name is optional, this is the default value
$client->getConfig('handler')->push($middleware);

$response = $client->get('http://httpbin.org/delay/1');
var_dump((float) $response->getHeaderLine('X-Request-Duration')); // 1.177
```

Installation
------------
```
composer require bentools/guzzle-duration-middleware
```

Tests
-----
```
./vendor/bin/phpunit
```