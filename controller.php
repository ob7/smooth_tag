<?php

namespace Concrete\Package\SmoothTag;
use Package;
use Page;
use \Concrete\Core\Page\Single as SinglePage;
use AssetList;
use \Concrete\Core\Asset\Asset;
use Config;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

    protected $pkgHandle = 'smooth_tag';
    protected $appVersionRequired = '5.7.1';
    protected $pkgVersion = '0.1.2';

    public function getPackageDescription()
    {
        return t("Adds smooth scrolling to a href tag links (such as #top) on the same page");
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
            $sp->update(array('cName'=>t('Smooth Tag'), 'cDescription'=>'Adds smooth scrolling to a href tag links on the same page'));
        }
        $sp = Page::getByPath('/dashboard/smooth_tag/settings');
        if(!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('dashboard/smooth_tag/settings', $pkg);
            $sp->update(array('cName'=>t('Smooth Tag Settings'), 'cDescription'=>''));
        }

        $pkg->getConfig()->save('archebian.smooth_tag.enabled', true); // enable plugin on install
    }

    public function on_start()
    {
        $pkg = Package::getByHandle('smooth_tag');
        $enableSmoothTag = $pkg->getConfig()->get('archebian.smooth_tag.enabled');

        //if smooth_tag is enabled from dashboard, inject smoothTag.js into all non-admin page footers
        if($enableSmoothTag > 0) {

            \Events::addListener(
                'on_page_view',
                function ($e) {
                    $html = \Loader::helper('html');
                    $page = $e->getPageObject();

                    $systemPage = $page->isAdminArea();
                    if(!$systemPage) {
                        $v = \View::getInstance();
                        $v->addFooterItem($html->javascript('smoothTag.js', $this->pkgHandle));
                    }
                }
            );

        }

        //register bootstrap switch
        $al = AssetList::getInstance();
        $al->register('javascript', 'bootstrapswitch', 'vendor/bootstrap-switch/bootstrap-switch.min.js',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $this
        );
        $al->register('css', 'bootstrapswitch', 'vendor/bootstrap-switch/bootstrap-switch.min.css',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => false, 'combine' => false), $this
		    );

        // bootstrap callout css
        $al->register('css', 'bootstrapcallout', 'vendor/bootstrap-callout/bs-callout.css',
                      array('version' => '3.3.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => false), $this
		    );
    }

}
?>
