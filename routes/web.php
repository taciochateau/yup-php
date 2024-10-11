$router->post('/api/register', 'AuthController@register');
$router->post('/api/login', 'AuthController@login');
$router->post('/api/me', ['middleware' => 'auth', 'uses' => 'AuthController@me']);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('/api/news/create', 'NotificationController@create');
    $router->post('/api/news/update/{news_id}', 'NotificationController@update');
    $router->post('/api/news/delete/{news_id}', 'NotificationController@delete');
    $router->get('/api/news/me', 'NotificationController@myNotifications');
    $router->get('/api/news/type/{type_id}', 'NotificationController@notificationsByType');

    $router->post('/api/type/create', 'NotificationTypeController@create');
    $router->post('/api/type/update/{type_id}', 'NotificationTypeController@update');
    $router->post('/api/type/delete/{type_id}', 'NotificationTypeController@delete');
    $router->get('/api/type/me', 'NotificationTypeController@myTypes');
});