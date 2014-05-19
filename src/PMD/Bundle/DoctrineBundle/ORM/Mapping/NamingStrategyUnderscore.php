<?php

namespace PMD\DoctrineBundle\ORM\Mapping;

use Doctrine\ORM\Mapping\UnderscoreNamingStrategy as BaseNamingStrategy;
use PMD\DoctrineBundle\Util\ReflectionBundle;

/**
 * Class NamingStrategyUnderscore
 * @package PMD\DoctrineBundle\ORM\Mapping
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
