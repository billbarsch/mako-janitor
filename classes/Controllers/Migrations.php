<?php
namespace softr\MakoJanitor\Controllers;

/**
 * Migrations
 *
 * @copyright  (c) 2017
 */
class Migrations extends \softr\MakoJanitor\Controllers\Index
{
    /**
     * List migrations entries
     *
     * @access  public
     * @return  ViewFactory
     */
    public function getIndex()
    {
        return $this->view->create('mako-janitor::templates.migrations.index',
        [
            'migrations' => $this->migrationJanitor->asc()->all(),
            'hasPendingMigrations' => $this->migrationJanitor->hasPending(),
        ]);
    }

    /**
     * Apply outstanding migrations
     *
     * @access  public
     * @return  string
     */
    public function getUp()
    {
        if ($this->migrationJanitor->up()) {
            $this->session->putFlash('success', 'Todas as alterações do banco de dados foram aplicadas com sucesso!');
        }

        return $this->response->redirect($this->request->referer());
    }
}