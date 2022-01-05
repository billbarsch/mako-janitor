<?php
namespace softr\MakoJanitor;

use softr\MakoJanitor\Services\Log;
use softr\MakoJanitor\Services\Migration;

/**
 * Mako Janitor package.
 *
 * @author     Agência Softr Ltda
 * @copyright  (c) 2017
 */
class MakoJanitorService extends \mako\application\services\Service
{
    /**
     * Register the service.
     *
     * @access  public
     */
    public function register()
    {
        $this->container->registerSingleton(['softr\MakoJanitor\Services\Log', 'logJanitor'], function($container)
        {
            return new Log($container->get('fileSystem'));
        });

        $this->container->registerSingleton(['softr\MakoJanitor\Services\Migration', 'migrationJanitor'], function($container)
        {
            return new Migration($container, $container->get('database'), $container->get('fileSystem'));
        });

        $this->registerRoutes();
    }

    /**
     * Register filters.
     *
     * @access  private
     */
    private function registerRoutes()
    {
        $groupOptions = [
            'prefix' => $this->container->get('config')->get('mako-janitor::config.prefix', '/system-janitor'),
        ];

        $this->container->get('routes')->group($groupOptions, function($routes)
        {
            $routes->get('/', 'softr\MakoJanitor\Controllers\Index::getIndex');
            $routes->post('/crypt-password/', 'softr\MakoJanitor\Controllers\Index::postCryptPassword');
            $routes->post('/save-revenue-comission/', 'softr\MakoJanitor\Controllers\Index::postSaveRevenueComission');

            $routes->get('/login/', 'softr\MakoJanitor\Controllers\Login::getIndex');
            $routes->get('/login/logout/', 'softr\MakoJanitor\Controllers\Login::getLogout');
            $routes->post('/login/auth/', 'softr\MakoJanitor\Controllers\Login::postAuth');

            $routes->get('/logs/', 'softr\MakoJanitor\Controllers\Logs::getIndex');
            $routes->get('/logs/clear/', 'softr\MakoJanitor\Controllers\Logs::getClear');
            $routes->get('/logs/read/{id}', 'softr\MakoJanitor\Controllers\Logs::getRead');
            $routes->get('/logs/delete/{id}', 'softr\MakoJanitor\Controllers\Logs::getDelete');

            $routes->get('/migrations/', 'softr\MakoJanitor\Controllers\Migrations::getIndex');
            $routes->get('/migrations/up/', 'softr\MakoJanitor\Controllers\Migrations::getUp');

            $routes->get('/settings/', 'softr\MakoJanitor\Controllers\Settings::getIndex');
            $routes->post('/settings/update/', 'softr\MakoJanitor\Controllers\Settings::postUpdate');
        });
    }
}