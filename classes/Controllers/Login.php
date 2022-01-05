<?php
namespace softr\MakoJanitor\Controllers;

use \mako\utility\Str;
use \mako\utility\UUID;

/**
 * Login
 *
 * @copyright  (c) Aliadus
 */
class Login extends \softr\MakoJanitor\Controllers\Index
{
    /**
     * Login screen
     *
     * @access  public
     * @return  ViewFactory
     */
    public function getIndex()
    {
        $sessionId = md5($this->config->get('application.secret') . date('Ymd'));

        if ($this->session->get($sessionId)) {
            return $this->response->redirect($this->base);
        }

        $this->session->regenerateId(true);

        $this->session->put('csrf_matches', md5(UUID::v4()));

        return $this->view->create('mako-janitor::templates.login.index',
        [
            'csrf_matches' => $this->session->get('csrf_matches'),
            'csrf_compare' => $this->session->generateToken(),
        ]);
    }

    /**
     * Do Logout
     *
     * @access  public
     */
    public function getLogout()
    {
        $this->session->clear();
        $this->session->destroy();
        $this->session->regenerateId();

        return $this->response->redirect($this->base . '/login/');
    }

    /**
     * Do Post Login
     *
     * @access  public
     * @return  Json
     */
    public function postAuth()
    {
        $csrf_matches = $this->session->get('csrf_matches', 'csrf_matches');

        if (in_array($this->request->post($csrf_matches), $this->session->get('mako.tokens', [])) === false) {
            $this->session->clear();
            $this->session->destroy();
            $this->session->regenerateId();

            return $this->response->redirect($this->base . '/login/');
        }

        $security = $this->config->get('mako-janitor::config.login.security');

        $password = $this->request->post('password');

        $crypto = $this->crypto->instance();

        if ($password && $password == $crypto->decrypt($security)) {
            $sessionId = md5($this->config->get('application.secret') . date('Ymd'));

            $this->session->put($sessionId, true);

            return $this->response->redirect($this->base);
        }

        $this->session->clear();
        $this->session->regenerateId(true);

        $this->session->putFlash('error', 'Login inválido!');

        return $this->response->redirect($this->base . '/login/');
    }
}