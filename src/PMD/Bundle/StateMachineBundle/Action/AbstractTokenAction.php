<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\StateMachineBundle\Behavior\AbstractConfigurableBehavior;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class AbstractTokenAction
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Action
 */
abstract class AbstractTokenAction extends AbstractConfigurableBehavior
{
    /**
     * @param TokenInterface $token
     * @param Request $request
     * @return Response|mixed
     */
    public function execute(
        TokenInterface $token,
        Request $request
    ) {
        if (!$this->isEnabled($token)) {
            return null;
        }

        return $this->postExecute($token, $request);
    }

    /**
     * @param TokenInterface $token
     * @param Request $request
     * @return Response|mixed
     */
    abstract protected function postExecute(
        TokenInterface $token,
        Request $request
    );
}
