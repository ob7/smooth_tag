<?php
namespace Concrete\Package\SmoothTag\Src\SmoothTagConfig;
use Package; //used to get package handle

class SmoothTagConfig {
    public function packageHandle()
    {
        $pkg = Package::getByHandle('smooth_tag');
        return $pkg;
    }
    public function setConfig() // used to set initial configuration
    {
        $config = SmoothTagConfig::defaults();
        $pkg = SmoothTagConfig::packageHandle();
        foreach ($config as $item => $value) {
            $pkg->getConfig()->save('archebian.smoothtag.'.$item, $value);
        }
    }
    public function loadConfig() // used to load saved configuration by settings page and json route
    {
        $config = SmoothTagConfig::getKeys();
        $pkg = SmoothTagConfig::packageHandle();
        $settings = array(); //will hold saved settings
        foreach ($config as $key) {
            $value = $pkg->getConfig()->get('archebian.smoothtag.'.$key); // get saved value via key name
            $settings[$key] = $value; // add value to array as config[key] = value
        }
        return $settings;
    }
    public function getKeys() //used to get available config keys based on 'defaults' keys
    {
        $config = SmoothTagConfig::defaults();
        $keys = array();
        foreach($config as $key => $value) {
            $keys[] = $key;
        }
        return $keys;
    }
    public function defaults()
    {
        return array(
            'enabled' => true,
            'include' => 'body .smooth-tag-include',
            'exclude' => '.ccm-image-slider-container .smooth-tag-exclude'
        );
    }
}
