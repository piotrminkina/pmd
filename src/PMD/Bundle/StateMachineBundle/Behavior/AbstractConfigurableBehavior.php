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

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PMD\StateMachineBundle\Behavior\Resolver\TokenOptionsResolverInterface;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class AbstractConfigurableBehavior
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Behavior
 */
abstract class AbstractConfigurableBehavior implements TokenConfigurableInterface
{
    /**
     * @var TokenOptionsResolverInterface
     */
    private $resolver;

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'enabled' => false,
            )
        );
        $resolver->setAllowedTypes(
            array(
                'enabled' => 'bool',
            )
        );
        $resolver->setOptional(array('enabled'));
    }

    /**
     * @inheritdoc
     */
    public function setTokenOptionsResolver(
        TokenOptionsResolverInterface $resolver
    ) {
        $this->resolver = $resolver;
    }

    /**
     * @param TokenInterface $token
     * @return array
     */
    public function getOptions(TokenInterface $token)
    {
        return $this->resolver->resolveOptions($token);
    }

    /**
     * @param TokenInterface $token
     * @return mixed
     */
    public function isEnabled(TokenInterface $token)
    {
        return $this->getOptions($token)['enabled'];
    }
}
