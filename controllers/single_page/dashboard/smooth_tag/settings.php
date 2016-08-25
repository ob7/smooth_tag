<?php
namespace Concrete\Package\SmoothTag\Controller\SinglePage\Dashboard\SmoothTag;

use \Concrete\Core\Page\Controller\DashboardPageController;
use Config;
use Package;

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

        //Get included selecors
        $includeSelectors = $pkg->getConfig()->get('archebian.smooth_tag.include');
        $this->set('include', $includeSelectors);

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
