<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Twig;

use PMD\StateMachineBundle\Provider\TokensProviderInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class PMDStateMachineExtension
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Twig
 */
class PMDStateMachineExtension extends \Twig_Extension
{
    /**
     * @var TokensProviderInterface
     */
    protected $provider;

    /**
     * @param TokensProviderInterface $provider
     */
    public function __construct(TokensProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'pmd_state_machine_tokens',
                array($this->provider, 'getTokens')
            ),
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'pmd_state_machine';
    }
}
