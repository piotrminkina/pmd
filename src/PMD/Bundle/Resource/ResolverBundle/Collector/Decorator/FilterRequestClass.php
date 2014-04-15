<?php

namespace PMD\ResourcesResolverBundle\Collector\Decorator;

/**
 * Class FilterRequestClass
 * @package PMD\ResourcesResolverBundle\Collector\Decorator
 */
class FilterRequestClass extends AbstractRequestDecorator
{
    /**
     * @inheritdoc
     */
    public function collect()
    {
        $requirements = array();

        foreach ($this->collector->collect() as $name => $requirement) {
            $class = $requirement->getClass();

            if (!$class || !$this->request instanceof $class) {
                $requirements[$name] = $requirement;
            }
        }

        return $requirements;
    }
}
