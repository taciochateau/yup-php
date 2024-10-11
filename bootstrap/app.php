$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
]);

$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);