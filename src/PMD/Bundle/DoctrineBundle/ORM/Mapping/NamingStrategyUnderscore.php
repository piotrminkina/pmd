<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\DoctrineBundle\ORM\Mapping;

use Doctrine\ORM\Mapping\UnderscoreNamingStrategy as BaseNamingStrategy;
use PMD\Bundle\DoctrineBundle\Util\ReflectionBundle;

/**
 * Class NamingStrategyUnderscore
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\DoctrineBundle\ORM\Mapping
 */
class NamingStrategyUnderscore extends BaseNamingStrategy
{
    /**
     * @param string $className
     * @return string
     */
    public function classToTableName($className)
    {
        $bundleName = '';

        if (strpos($className, '\\') !== false) {
            $reflection = $this->createReflectionBundle($className);

            $bundleName = $reflection->getBundleName();
            $className = $reflection->getShortName();
        }

        return parent::classToTableName($bundleName . $className);
    }

    /**
     * @param string $className
     * @return ReflectionBundle
     */
    public function createReflectionBundle($className)
    {
        return new ReflectionBundle($className);
    }
}
