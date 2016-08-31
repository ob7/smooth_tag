<?php

namespace Concrete\Package\SmoothTag;
use Package;
use Page;
use SinglePage;
use Config;
use Core;
use \Concrete\Package\SmoothTag\Src\SmoothTagConfig\SmoothTagConfig;
use Route; // for registering route that returns config as JSON

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

    protected $pkgHandle = 'smooth_tag';
    protected $appVersionRequired = '5.7.1';
    protected $pkgVersion = '0.9';

    public function getPackageDescription()
    {
        return t("Adds a smooth scrolling effect to anchor tags within a page");
    }

    public function getPackageName()
    {
        return t("Smooth Link Scrolling");
    }

    public function install()
    {
        $pkg = parent::install();

        // create dashboard pages
        $sp = Page::getByPath('/dashboard/smooth_tag');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('/dashboard/smooth_tag', $pkg);
            $sp->update(array('cName'=>$this->getPackageName(), 'cDescription'=>$this->getPackageDescription()));
        }
        $sp = Page::getByPath('/dashboard/smooth_tag/settings');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('dashboard/smooth_tag/settings', $pkg);
            $sp->update(array('cName'=>$this->getPackageName() . t(' Settings'), 'cDescription'=>''));
        }
        SmoothTagConfig::setConfig(); // installs default configuration
    }

    public function on_start()
    {

        Route::register( // for returning config to javascript
            '/package/smoothtag/controller/config',
            'Concrete\Package\SmoothTag\Controller\config::get'
        );

        // check if plugin is enabled
        $pkg = Package::getByHandle('smooth_tag');
        $enableSmoothTag = $pkg->getConfig()->get('archebian.smoothtag.enabled');
        // check for admin page
        $page = $e->getPageObject();
        $systemPage = $page->isAdminArea();

        if($enableSmoothTag > 0 && !$systemPage) { // if not admin page and enabled
            \Events::addListener(
                'on_page_view',
                //load smooth tag javascript onto current page
                function ($e) {
                    $html = Core::make('helper/html'); //for adding footer items
                    $v = \View::getInstance(); //for targeting current page
                    $v->addFooterItem($html->javascript('smoothTag.js', $this->pkgHandle));
                }
            );
        }
    }

}
?>
