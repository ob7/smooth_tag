<?php
namespace Concrete\Package\SmoothTag\Controller\SinglePage\Dashboard\Smoothtag;

use \Concrete\Core\Page\Controller\DashboardPageController;
use Config;
use Package;
use AssetList; //for loading assets used on settings page
use \Concrete\Core\Asset\Asset;
use \Concrete\Package\SmoothTag\Src\SmoothTagConfig\SmoothTagConfig; //so we can load configuration

class Settings extends DashboardPageController {

    public function view()
    {
        $pkg = Package::getByHandle('smooth_tag');

        $keys = SmoothTagConfig::getKeys(); //ie enabled, include, exclude
        $config = SmoothTagConfig::loadConfig();
        foreach($keys as $key) {
            $this->set($key,$config[$key]); // set view variables as key = loadedConfig[key];
        }

        //register bootstrap switch used in single page form
        $al = AssetList::getInstance();
        $al->register('javascript', 'bootstrapswitch', 'vendor/bootstrap-switch/bootstrap-switch.min.js',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $pkg
        );
        $al->register('css', 'bootstrapswitch', 'vendor/bootstrap-switch/bootstrap-switch.min.css',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $pkg
		    );
        // register bootstrap callout css used in single page form
        $al->register('css', 'bootstrapcallout', 'vendor/bootstrap-callout/bs-callout.css',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => false), $pkg
		    );
        // Now require these assets
        $this->requireAsset('javascript','bootstrapswitch');
        $this->requireAsset('css','bootstrapswitch');
        $this->requireAsset('css','bootstrapcallout');
    }

    public function updated()
    {
        $this->set('message', t("Settings saved."));
        $this->view();
    }

    public function save_settings()
    {
        if ($this->token->validate("save_settings")) {
            if ($this->isPost()) {
                $configKeys = SmoothTagConfig::getKeys();
                $pkg = Package::getByHandle('smooth_tag');
                foreach ($configKeys as $key) {
                    $post = $this->post($key);
                    if ($key == 'exclude' && $post == "") { // javascript fails if exclude is empty, so we set it to the default if thats the case
                        $post = '.smooth-tag-exclude';
                    }
                    $pkg->getConfig()->save('archebian.smoothtag.'.$key, $post);
                }
                $this->redirect('/dashboard/smoothtag/settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }

}
