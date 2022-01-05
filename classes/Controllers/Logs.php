<?php
namespace softr\MakoJanitor\Controllers;

/**
 * Logs
 *
 * @author     Agência Softr Ltda
 * @copyright  (c) 2017
 */
class Logs extends \softr\MakoJanitor\Controllers\Index
{
    /**
     * List logs entries
     *
     * @access  public
     * @return  ViewFactory
     */
    public function getIndex()
    {
        return $this->view->create('mako-janitor::templates.logs.index',
        [
            'logs' => $this->logJanitor->asc()->all(),
        ]);
    }

    /**
     * Show log content
     *
     * @access  public
     * @param   integer  id  Log Id
     * @return  string
     */
    public function getRead($id)
    {
        return $this->view->create('mako-janitor::templates.logs.read',
        [
            'log' => $this->logJanitor->get($id),
        ]);
    }

    /**
     * Delete log file
     *
     * @access  public
     * @param   integer  id  Log Id
     * @return  boolean
     */
    public function getDelete($id)
    {
        if ($this->logJanitor->exists($id)) {
            $this->session->putFlash('success', 'Arquivo de log deletado!');

            $this->logJanitor->delete($id);
        }

        return $this->response->redirect($this->request->referer());
    }

    /**
     * Clear all log files
     *
     * @access  public
     * @return  json
     */
    public function getClear()
    {
        foreach ($this->logJanitor->all() as $id => $log) {
            $this->logJanitor->delete($id);
        }

        $this->session->putFlash('success', 'Os registros de log foram limpos!');

        return $this->response->redirect($this->request->referer());
    }
}