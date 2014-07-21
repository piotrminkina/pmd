<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Behavior\Resolver;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PMD\StateMachineBundle\Behavior\Options\OptionsRegistryInterface;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class TokenOptionsResolver
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Behavior\Resolver
 */
class TokenOptionsResolver implements TokenOptionsResolverInterface
{
    /**
     * @var OptionsRegistryInterface
     */
    protected $registry;

    /**
     * @var OptionsResolverInterface
     */
    protected $defaultOptions;

    /**
     * @param OptionsRegistryInterface $registry
     */
    public function __construct(OptionsRegistryInterface $registry)
    {
        $this->registry = $registry;
        $this->defaultOptions = $this->createOptionsResolver();
    }

    /**
     * @param OptionsResolverInterface $defaultOptions
     * @return TokenOptionsResolver
     */
    public function setDefaultOptions(OptionsResolverInterface $defaultOptions)
    {
        $this->defaultOptions = $defaultOptions;

        return $this;
    }

    /**
     * @return OptionsResolverInterface
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    /**
     * @inheritdoc
     */
    public function resolveOptions(TokenInterface $token)
    {
        $accessKey = array(
            $token->getDefinition()->getName(),
            $token->getInstance()->getState()->getName(),
            $token->getTransition()->getLabel(),
        );
        $accessKey = join('.', $accessKey);
        $options = array();

        if ($this->registry->has($accessKey)) {
            $options = $this->registry->get($accessKey);
        }

        return $this->defaultOptions->resolve($options);
    }

    /**
     * @return OptionsResolverInterface
     */
    protected function createOptionsResolver()
    {
        return new OptionsResolver();
    }
}
