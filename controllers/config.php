<?php
namespace Concrete\Package\SmoothTag\Controller;
use Concrete\Core\Controller\Controller;
use \Concrete\Package\SmoothTag\Src\SmoothTagConfig\SmoothTagConfig;
use Core;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Config extends Controller {
    public function get()
    {
        $config = SmoothTagConfig::loadConfig();
        $ajax = Core::make('helper/ajax');
        $ajax->sendResults($config);
    }
}
