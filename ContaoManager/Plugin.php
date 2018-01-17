<?php

namespace con4gis\FirefighterBundle\ContaoManager;

use con4gis\CoreBundle\con4gisCoreBundle;
use con4gis\PoimanagerBundle\con4gisFirefighterBundle;
use con4gis\ProjectsBundle\con4gisProjectsBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Config\ConfigInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;

class Plugin implements BundlePluginInterface
{
    /**
     * Gets a list of autoload configurations for this bundle.
     *
     * @param ParserInterface $parser
     *
     * @return ConfigInterface[]
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(con4gisFirefighterBundle::class)
                ->setLoadAfter([con4gisCoreBundle::class],[con4gisMapsBundle::class],[con4gisProjectsBundle::class])
        ];
    }
}