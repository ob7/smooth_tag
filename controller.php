<?php         

namespace Concrete\Package\SmoothTag;
use Package;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

	protected $pkgHandle = 'smooth_tag';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '0.1.0';
	
	
	
	public function getPackageDescription()
	{
		return t("Adds smooth scrolling to a href tag links (such as #top)");
	}

	public function getPackageName()
	{
		return t("Smooth A Tag Link Scrolling");
	}
	
	public function install()
	{
		$pkg = parent::install();
	}

	public function on_start() 
	{
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
}
?>
