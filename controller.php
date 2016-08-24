<?php

namespace Concrete\Package\SmoothTag;
use Package;
use Page;
use \Concrete\Core\Page\Single as SinglePage; //documentation.concrete5.org/developers/working-with-pages/single-pages/including-single-pages-and-controllers-in-packages

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

    protected $pkgHandle = 'smooth_tag';
    protected $appVersionRequired = '5.7.1';
    protected $pkgVersion = '0.1.1';

    public function getPackageDescription()
    {
        return t("Adds smooth scrolling to a href tag links (such as #top)");
    }

    public function getPackageName()
    {
        return t("Smooth Tag");
    }

    public function install()
    {
        $pkg = parent::install();

        $sp = Page::getByPath('/dashboard/smooth_tag');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('/dashboard/smooth_tag', $pkg);
            $sp->update(array('cName'=>t('Smooth Tag'), 'cDescription'=>'Adds smooth scrolling to a href tag links on the same page')); // this is displayed in the package overview after being installed, and the cName is used for the single pages view as long as the page controller has a view function
        }
        $sp = Page::getByPath('/dashboard/smooth_tag/settings');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('dashboard/smooth_tag/settings', $pkg);
            $sp->update(array('cName'=>t('Smooth Tag Settings'), 'cDescription'=>''));
        }

    }

    public function on_start() // code runs
    {
        $pkg = Package::getByHandle('smooth_tag');
        $enableSmoothTag = $pkg->getConfig()->get('archebian.smooth_tag.enabled');
        if($enableSmoothTag > 0) {

            \Events::addListener(
                'on_page_view',
                function ($e) {
                    $html = \Loader::helper('html');
                    $page = $e->getPageObject();

                    $systemPage = $page->isAdminArea(); //we dont want this enabled on admin pages
                    if(!$systemPage) {
                        $v = \View::getInstance();
                        $v->addFooterItem($html->javascript('smoothTag.js', $this->pkgHandle));
                    }
                }
            );

        }
    }

}
?>
