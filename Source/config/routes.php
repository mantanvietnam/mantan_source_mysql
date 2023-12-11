<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        include('routes_slugs.php');

        $builder->connect('/', ['controller' => 'Homes', 'action' => 'index']);

        $builder->connect('/apis/updateLinkMenu', ['controller' => 'Apis', 'action' => 'updateLinkMenu']);

        $builder->connect('/menus/delete', ['controller' => 'Menus', 'action' => 'delete']);

        $builder->connect('/admins', ['controller' => 'Admins', 'action' => 'index']);
        $builder->connect('/admins/login', ['controller' => 'Admins', 'action' => 'login']);
        $builder->connect('/admins/logout', ['controller' => 'Admins', 'action' => 'logout']);
        $builder->connect('/admins/changePass', ['controller' => 'Admins', 'action' => 'changePass']);
        $builder->connect('/admins/profile', ['controller' => 'Admins', 'action' => 'profile']);
        $builder->connect('/admins/listAdmin', ['controller' => 'Admins', 'action' => 'listAdmin']);
        $builder->connect('/admins/addAdmin', ['controller' => 'Admins', 'action' => 'addAdmin']);
        $builder->connect('/admins/deleteAdmin', ['controller' => 'Admins', 'action' => 'deleteAdmin']);

        $builder->connect('/options/infoSite', ['controller' => 'Options', 'action' => 'infoSite']);
        $builder->connect('/options/menus', ['controller' => 'Options', 'action' => 'menus']);

        $builder->connect('/options/plugins', ['controller' => 'Options', 'action' => 'plugins']);
        $builder->connect('/options/activePlugin', ['controller' => 'Options', 'action' => 'activePlugin']);
        $builder->connect('/options/deactivePlugin', ['controller' => 'Options', 'action' => 'deactivePlugin']);
        $builder->connect('/options/deletePlugin', ['controller' => 'Options', 'action' => 'deletePlugin']);

        $builder->connect('/options/themes', ['controller' => 'Options', 'action' => 'themes']);
        $builder->connect('/options/activeTheme', ['controller' => 'Options', 'action' => 'activeTheme']);
        $builder->connect('/options/deleteTheme', ['controller' => 'Options', 'action' => 'deleteTheme']);

        $builder->connect('/categories/post', ['controller' => 'Categories', 'action' => 'post']);
        $builder->connect('/categories/album', ['controller' => 'Categories', 'action' => 'album']);
        $builder->connect('/categories/video', ['controller' => 'Categories', 'action' => 'video']);
        $builder->connect('/categories/delete', ['controller' => 'Categories', 'action' => 'delete']);

        $builder->connect('/posts/list', ['controller' => 'Posts', 'action' => 'list']);
        $builder->connect('/posts/add', ['controller' => 'Posts', 'action' => 'add']);
        $builder->connect('/posts/delete', ['controller' => 'Posts', 'action' => 'delete']);

        $builder->connect('/pages/list', ['controller' => 'Posts', 'action' => 'list_page']);
        $builder->connect('/pages/add', ['controller' => 'Posts', 'action' => 'add_page']);
        $builder->connect('/pages/delete', ['controller' => 'Posts', 'action' => 'delete_page']);

        $builder->connect('/albums/list', ['controller' => 'Albums', 'action' => 'list']);
        $builder->connect('/albums/add', ['controller' => 'Albums', 'action' => 'add']);
        $builder->connect('/albums/delete', ['controller' => 'Albums', 'action' => 'delete']);

        $builder->connect('/albuminfos/list', ['controller' => 'Albuminfos', 'action' => 'list']);
        $builder->connect('/albuminfos/add', ['controller' => 'Albuminfos', 'action' => 'add']);
        $builder->connect('/albuminfos/delete', ['controller' => 'Albuminfos', 'action' => 'delete']);

        $builder->connect('/videos/list', ['controller' => 'Videos', 'action' => 'list']);
        $builder->connect('/videos/add', ['controller' => 'Videos', 'action' => 'add']);
        $builder->connect('/videos/delete', ['controller' => 'Videos', 'action' => 'delete']);

        $builder->connect('/search/*', ['controller' => 'Homes', 'action' => 'search']);
        $builder->connect('/posts/', ['controller' => 'Homes', 'action' => 'category_post']);
        $builder->connect('/albums/', ['controller' => 'Homes', 'action' => 'category_album']);
        $builder->connect('/videos/', ['controller' => 'Homes', 'action' => 'category_video']);

        $builder->connect('/apis/*', ['controller' => 'Apis', 'action' => 'index']);

        // Route cho WebSocket server
        $builder->connect('/websocket', ['controller' => 'WebSocketServer']);


        $builder->connect('/plugins/admin/*', ['controller' => 'Plugins', 'action' => 'admin']);
        $builder->connect('/*', ['controller' => 'Plugins', 'action' => 'index']);
        
        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
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
