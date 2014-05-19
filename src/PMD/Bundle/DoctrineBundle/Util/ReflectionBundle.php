<?php

namespace PMD\DoctrineBundle\Util;

/**
 * Class ReflectionBundle
 * @package PMD\DoctrineBundle\Util
 */
class ReflectionBundle extends \ReflectionClass
{
    /**
     * @return string
     */
    public function getVendorName()
    {
        $namespaceName = $this->getNamespaceName();
        $namespace = $this->explodeNamespaceName($namespaceName);
        $vendor = array_shift($namespace);

        return $vendor;
    }

    /**
     * @param bool $withSuffix
     * @return string
     */
    public function getBundleName($withSuffix = false)
    {
        $namespaceName = $this->getNamespaceName();
        $namespace = $this->explodeNamespaceName($namespaceName);

        array_shift($namespace); // Shift Vendor name
        $bundleName = array_shift($namespace);

        if ('Bundle' == $bundleName) {
            $bundleName = array_shift($namespace);
        }

        if (!$withSuffix) {
            $bundleName = basename($bundleName, 'Bundle');
        }

        return $bundleName;
    }

    /**
     * @param string $namespaceName
     * @return array
     */
    protected function explodeNamespaceName($namespaceName)
    {
        return explode('\\', $namespaceName);
    }
}
