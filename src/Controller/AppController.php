<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        global $urlThemeActive;
        global $themeActive;
        global $session;
        global $modelOptions;
        global $modelCategories;
        global $urlCurrent;
        global $isRequestPost;
        global $controller;
        global $csrfToken;

        $session = $this->request->getSession();
        $urlCurrent = $_SERVER['REQUEST_URI'];
        $isRequestPost = $this->request->is('post');
        $controller = $this;
     
        $csrfToken = $this->request->getAttribute('csrfToken');

        // load model hệ thống
        $modelOptions = $this->loadModel('Options');
        $modelCategories = $this->loadModel('Categories');
        
        // load plugin đã cài đặt
        $conditions = array('key_word' => 'plugins_site');
        $plugins_site = $modelOptions->find()->where($conditions)->first();
        if(empty($plugins_site)){
            $plugins_site = $modelOptions->newEmptyEntity();
        }

        $plugins_site_value = array();
        if(!empty($plugins_site->value)){
            $plugins_site_value = json_decode($plugins_site->value, true);
        }
        
        if(!empty($plugins_site_value)){
            foreach ($plugins_site_value as $name) {
                $filename = __DIR__.'/../../plugins/'.$name.'/function.php';
                if (file_exists($filename))
                {   
                    include_once($filename);
                }

                $filename = __DIR__.'/../../plugins/'.$name.'/routes.php';
                if (file_exists($filename))
                {   
                    include_once($filename);
                }

                $filename = __DIR__.'/../../plugins/'.$name.'/controller.php';
                if (file_exists($filename))
                {   
                    include_once($filename);
                }

                $filename = __DIR__.'/../../plugins/'.$name.'/model.php';
                if (file_exists($filename))
                {   
                    include_once($filename);
                }
            }
        }

        // load theme đã kích hoạt
        $conditions = array('key_word' => 'theme_active_site');
        $theme_active_site = $modelOptions->find()->where($conditions)->first();
        if(empty($theme_active_site)){
            $theme_active_site = $modelOptions->newEmptyEntity();
        }

        if(empty($theme_active_site->value)){
            $theme_active_site->key_word = 'theme_active_site';
            $theme_active_site->value = 'toptop';

            $modelOptions->save($theme_active_site);
        }

        $urlThemeActive = '/themes/'.$theme_active_site->value.'/';
        $themeActive = $theme_active_site->value;

        $filename = __DIR__.'/../../themes/'.$themeActive.'/function.php';
        if (file_exists($filename))
        {   
            include_once($filename);
        }

        $filename = __DIR__.'/../../themes/'.$themeActive.'/routes.php';
        if (file_exists($filename))
        {   
            include_once($filename);
        }

        $filename = __DIR__.'/../../themes/'.$themeActive.'/controller.php';
        if (file_exists($filename))
        {   
            include_once($filename);
        }

        $filename = __DIR__.'/../../themes/'.$themeActive.'/model.php';
        if (file_exists($filename))
        {   
            include_once($filename);
        }
    }
}
