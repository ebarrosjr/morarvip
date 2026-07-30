<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        $builder->connect('/interesses', ['controller' => 'Atendimentos', 'action' => 'interesses']);
        $builder->connect('/esqueci', ['controller' => 'Users', 'action' => 'esqueci']);
        $builder->connect('/nova-senha/{token}', [
            'controller' => 'Users',
            'action' => 'novaSenha',
        ])->setPass(['token'])->setPatterns([
            'token' => '[a-f0-9]{64}',
        ]);
        $builder->connect('/{controller}', ['action' => 'index']);
        $builder->connect('/{controller}/{action}/*', []);

        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
