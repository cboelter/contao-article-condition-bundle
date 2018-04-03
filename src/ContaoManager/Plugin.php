<?php

namespace Boelter\ArticleConditionBundle\ContaoManager;

use Boelter\ArticleConditionBundle\ArticleConditionBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Class Plugin
 * @package Boelter\ArticleConditionBundle\ContaoManager
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ArticleConditionBundle::class)->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
