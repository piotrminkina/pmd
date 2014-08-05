<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Behavior;

use PMD\StateMachineBundle\Behavior\Resolver\TokenOptionsResolver;

/**
 * Class TokenConfigurableConfigurator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Behavior
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
