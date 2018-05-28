<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Plugin\EtdTwigExtension\Twig\EtdTwigExtension;

class EtdTwigExtensionPlugin extends Plugin
{

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 1000]
        ];
    }

    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onTwigExtensions' => ['onTwigExtensions', 1000]
        ]);
    }

    /**
     * Add the Twig Extensions
     */
    public function onTwigExtensions()
    {
        require_once __DIR__ . '/classes/Twig/EtdTwigExtension.php';

        $this->grav['twig']->twig->addExtension(new EtdTwigExtension);

    }

}
