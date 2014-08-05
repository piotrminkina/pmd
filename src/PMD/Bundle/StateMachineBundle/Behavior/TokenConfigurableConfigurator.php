<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Behavior;

use PMD\Bundle\StateMachineBundle\Behavior\Resolver\TokenOptionsResolver;

/**
 * Class TokenConfigurableConfigurator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Behavior
 */
class TokenConfigurableConfigurator
{
    /**
     * @var TokenOptionsResolver
     */
    protected $resolver;
    
    /**
     * @param TokenOptionsResolver $resolver
     */
    public function __construct(TokenOptionsResolver $resolver)
    {
        $this->resolver = $resolver;
    }
    
    /**
     * @param TokenConfigurableInterface $configurable
     */
    public function configure(TokenConfigurableInterface $configurable)
    {
        $defaultOptions = $this->resolver->getDefaultOptions();
        $configurable->setDefaultOptions($defaultOptions);
        $this->resolver->setDefaultOptions($defaultOptions);

        $configurable->setTokenOptionsResolver($this->resolver);
    }
}
