<?php
namespace softr\MakoJanitor\Controllers;

/**
 * Settings
 *
 * @copyright  (c) 2017
 */
class Settings extends \softr\MakoJanitor\Controllers\Index
{
    /**
     * GET - Show Settings Form
     *
     * @access  public
     * @return  ViewFactory
     */
    public function getIndex()
    {
        return $this->view->create('mako-janitor::templates.settings.index');
    }

    /**
     * POST - Update settings
     *
     * @access  public
     * @return  Json
     */
    public function postUpdate()
    {
        // Save settings
        foreach ($this->request->post('settings', []) as $key => $value) {
            $this->setting->set($key, $value);
        }

        // Return response
        return json_encode([
            'status' => 'success',
        ]);
    }
}
