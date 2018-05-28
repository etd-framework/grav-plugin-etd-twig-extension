<?php
namespace Grav\Plugin\EtdTwigExtension\Twig;

class EtdTwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('ampUrl', [$this, 'ampUrl'], ['is_safe' => ['html']]),
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

        return $amp->canonical();
    }

}
