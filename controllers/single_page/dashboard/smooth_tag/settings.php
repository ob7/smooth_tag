<?php
namespace Concrete\Package\SmoothTag\Controller\SinglePage\Dashboard\SmoothTag;

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

        // Get enable/disable config
        $enableSmoothTag = $pkg->getConfig()->get('archebian.smooth_tag.enabled');
        $this->set('enableSmoothTag', $enableSmoothTag);

        // Get exluded selectors
        $excludeSelectors = $pkg->getConfig()->get('archebian.smooth_tag.exclude');
        $this->set('exclude', $excludeSelectors);

        //Get included selectors
        $includeSelectors = $pkg->getConfig()->get('archebian.smooth_tag.include');
        $this->set('include', $includeSelectors);

        $keys = SmoothTagConfig::getKeys();
        $config = SmoothTagConfig::loadConfig();
        foreach($keys as $key) {
            $this->set($key,$config[$key]); // set view variables as key = loadedConfig[key];
        }
        //THIS IS WHERE YOU LEFT OFF



        //register bootstrap switch used in single page form
        $al = AssetList::getInstance();
        $al->register('javascript', 'bootstrapswitch', 'vendor/bootstrap-switch/bootstrap-switch.min.js',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $this
        );
        $al->register('css', 'bootstrapswitch', 'vendor/bootstrap-switch/bootstrap-switch.min.css',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $this
		    );

        // bootstrap callout css used in single page form
        $al->register('css', 'bootstrapcallout', 'vendor/bootstrap-callout/bs-callout.css',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => false), $this
		    );
        // Assets for bootstrap checkbox as switch
        $this->requireAsset('javascript','bootstrapswitch');
        $this->requireAsset('css','bootstrapswitch');
        // bootstrap callouts css
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
                $enableSmoothTag = $this->post('enableSmoothTag') ? 1 : 0;
                $excludeSelectors = $this->post('exclude');
                $includeSelectors = $this->post('include');
                $pkg = Package::getByHandle('smooth_tag');
                $pkg->getConfig()->save('archebian.smooth_tag.enabled', $enableSmoothTag);
                $pkg->getConfig()->save('archebian.smooth_tag.exclude', $excludeSelectors);
                $pkg->getConfig()->save('archebian.smooth_tag.include', $includeSelectors);
                $this->redirect('/dashboard/smooth_tag/settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }

}
