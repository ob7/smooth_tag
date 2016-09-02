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
    protected $appVersionRequired = '5.7.5.1';
    protected $pkgVersion = '0.9.1';

    public function getPackageDescription()
    {
        return t("Adds a smooth scrolling effect to anchor links on a page");
    }

    public function getPackageName()
    {
        return t("Smooth Link Scrolling");
    }

    public function install()
    {
        $pkg = parent::install();

        // create dashboard pages
        $sp = Page::getByPath('/dashboard/smoothtag');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('/dashboard/smoothtag', $pkg);
            $sp->update(array('cName'=>$this->getPackageName(), 'cDescription'=>$this->getPackageDescription()));
        }
        $sp = Page::getByPath('/dashboard/smoothtag/settings');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('dashboard/smoothtag/settings', $pkg);
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

        \Events::addListener(
            'on_page_view',
            //load smooth tag javascript onto current page
            function ($e) {
                $page = $e->getPageObject(); // get current page object
                // check if plugin is enabled
                $pkg = Package::getByHandle('smooth_tag'); //get handle
                $enabled = $pkg->getConfig()->get('archebian.smoothtag.enabled'); // check enabled value
                // check for admin page
                console.log(`enabled is ${enabled}`);
                $systemPage = $page->isAdminArea();
                if($enabled > 0 && !$systemPage) { // if plugin enabled and not an admin page
                    $html = Core::make('helper/html'); //for adding footer items
                    $v = \View::getInstance(); //for targeting current page
                    $v->addFooterItem($html->javascript('smoothTag.js', $this->pkgHandle));
                }
            }
        );
    }

}
?>
