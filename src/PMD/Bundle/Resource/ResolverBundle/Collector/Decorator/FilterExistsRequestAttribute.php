<?php

namespace PMD\ResourcesResolverBundle\Collector\Decorator;

/**
 * Class FilterExistsRequestAttribute
 * @package PMD\ResourcesResolverBundle\Collector\Decorator
 */
class FilterExistsRequestAttribute extends AbstractRequestDecorator
{
    /**
     * @inheritdoc
     */
    public function collect()
    {
        $requirements = array();

        foreach ($this->collector->collect() as $name => $requirement) {
            if (!$this->request->attributes->has($name)) {
                $requirements[$name] = $requirement;
            }
        }

        return $requirements;
    }
}
