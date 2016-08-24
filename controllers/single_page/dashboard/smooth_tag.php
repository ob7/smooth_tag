<?php
namespace Concrete\Package\SmoothTag\Controller\SinglePage\Dashboard;

use \Concrete\Core\Page\Controller\DashboardPageController;

class SmoothTag extends DashboardPageController {

    public function view()
    {
        $this->redirect('/dashboard/smooth_tag/settings');
    }

}
