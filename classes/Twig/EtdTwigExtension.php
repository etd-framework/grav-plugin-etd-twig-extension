<?php
namespace Grav\Plugin\EtdTwigExtension\Twig;

class EtdTwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('ampUrl', [$this, 'ampUrl'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('minify', [$this, 'minify'], ['is_safe' => ['all']]),
        ];
    }

    /**
     * @param \Grav\Common\Page\Page $page
     * @param string $extension
     */
    public function ampUrl($page, $extension = '.amp')
    {
        $amp = clone $page;
        $amp->modifyHeader('append_url_extension', $extension);

        $is_home = $amp->home();
        if ($is_home) {
            $home = Grav::instance()['config']->get('system.home.alias');
            Grav::instance()['config']->set('system.home.alias', '####FAKE####');
        }

        $url = $amp->canonical();

        if ($is_home) {
            Grav::instance()['config']->set('system.home.alias', $home);
        }

        return $url;
    }

    public function minify($buffer, $type = 'css') {

        $minifier = ($type == 'css') ? new \MatthiasMullie\Minify\CSS() : new \MatthiasMullie\Minify\JS();
        $minifier->add($buffer);

        return $minifier->minify();

    }

}
