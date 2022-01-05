<?php
namespace softr\MakoJanitor\Controllers;

use \mako\utility\Arr;

/**
 * Index - Dashboard Controller
 *
 * @copyright  (c) 2017
 */
class Index extends \mako\http\routing\Controller
{
    use \mako\syringe\ContainerAwareTrait;

    /**
     * Execute controller before filter
     *
     * @access  public
     */
    public function beforeFilter()
    {
        $this->view->assign('config', $this->config);
        $this->view->assign('session', $this->session);
        $this->view->assign('urlBuilder', $this->urlBuilder);

        $this->prefix = $prefix = $this->config->get('mako-janitor::config.prefix', '/sysadmin');

        $this->base = $this->urlBuilder->to($prefix);
        $this->view->assign('__base__', $this->urlBuilder->to($prefix . '/'));

        $sessionId = md5($this->config->get('application.secret') . date('Ymd'));

        if (!$this->session->get($sessionId)) {
            if ($this->urlBuilder->matches($prefix . '/login/') == false) {
                return $this->response->redirect($this->base . '/login/');
            }
        }
    }

    /**
     * Dashboard
     *
     * @access  public
     * @return  ViewFactory
     */
    public function getIndex()
    {
        $builder = $this->database->builder();

        return $this->view->create('mako-janitor::templates.dashboard',
        [
            'lastLogs' => array_slice($this->logJanitor->desc()->all()->getItems(), 0, 10),
            'lastMigrations' => array_slice($this->migrationJanitor->desc()->all()->getItems(), 0, 6),
            'hasPendingMigrations' => $this->migrationJanitor->hasPending(),
        ]);
    }

    /**
     * Return encrypted password
     *
     * @access  public
     * @return  string
     */
    public function postCryptPassword()
    {
        $password = $this->request->post('password');

        if ($password) {
            $config = [
                'prefix' => $this->config->get('mako-janitor::config.prefix'),
                'login' => [
                    'security' => $security = $this->crypto->instance()->encrypt($password),
                ],
            ];

            file_put_contents($this->getPackageConfigFile(), "<?php return json_decode('" . json_encode($config) . "', true); ?>");

            return json_encode([
                'status' => 'success',
                'password' => $security,
            ]);
        }

        return json_encode(['status' => 'error']);
    }

    /**
     * Return package config file path
     *
     * @return  string
     */
    private function getPackageConfigFile()
    {
        $packageConfigPath = sprintf('%s/config/packages/mako-janitor', MAKO_APPLICATION_PATH);

        if (is_dir($packageConfigPath) == false) {
            mkdir($packageConfigPath, 0777);
        }

        return sprintf('%s/config.php', $packageConfigPath);
    }

    /**
     * Returns a query builder instance.
     *
     * @access  private
     * @return  \mako\database\query\Query
     */
    private function getSettingsTable()
    {
        if ($this->schema->hasTable('configuracoes') == false) {
            $this->schema->create('configuracoes', function($table) {
                $table
                    ->addColumn('config_key', 'string', array('limit' => 128))
                    ->addColumn('config_value', 'text');
            });
        }

        return $this->database->builder()->table('configuracoes');
    }
}