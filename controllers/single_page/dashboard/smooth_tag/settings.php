<?php
namespace Concrete\Package\SmoothTag\Controller\SinglePage\Dashboard\SmoothTag;

use \Concrete\Core\Page\Controller\DashboardPageController;
use Config;
use Package;

class Settings extends DashboardPageController {

    public function view()
    {
        $pkg = Package::getByHandle('smooth_tag');
        $enableSmoothTag = $pkg->getConfig()->get('archebian.smooth_tag.enabled');
        $this->set('enableSmoothTag', $enableSmoothTag);
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
                $textBox = $this->post('textBox');
                $pkg = Package::getByHandle('smooth_tag');
                $pkg->getConfig()->save('archebian.smooth_tag.enabled', $enableSmoothTag);
                $this->redirect('/dashboard/smooth_tag/settings','updated');
            }
        } else {
            $this->set('error', array($this->token->getErrorMessage()));
        }
    }

}
