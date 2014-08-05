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

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PMD\Bundle\StateMachineBundle\Behavior\Resolver\TokenOptionsResolverInterface;

/**
 * Interface TokenConfigurableInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Behavior
 */
interface TokenConfigurableInterface
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);

    /**
     * @param TokenOptionsResolverInterface $resolver
     */
    public function setTokenOptionsResolver(TokenOptionsResolverInterface $resolver);
}
