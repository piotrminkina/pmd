<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Collector\Decorator;

/**
 * Class FilterExistsRequestAttribute
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Collector\Decorator
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
