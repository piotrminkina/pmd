<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\Bundle\StateMachineBundle\Process\Definition\StateInterface;
use PMD\Bundle\StateMachineBundle\Process\TokenReadInterface;

/**
 * Interface StateMachineInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle
 */
interface StateMachineInterface
{
    /**
     * @return StateInterface
     */
    public function getState();

    /**
     * @return mixed
     */
    public function getContext();

    /**
     * @return TokenReadInterface[]
     */
    public function getTokens();

    /**
     * @param string $name
     * @return boolean
     */
    public function hasToken($name);

    /**
     * @param string $name
     * @param Request $request
     * @return Response|mixed
     */
    public function applyToken($name, Request $request);
}
