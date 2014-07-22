<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Handler;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;
use PMD\StateMachineBundle\FactoryInterface;

/**
 * Class StateHandler
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Handler
 */
class StateHandler implements HandlerInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var string
     */
    protected $processPath;

    /**
     * @var string
     */
    protected $actionPath;

    /**
     * @var string
     */
    protected $responsePath;

    /**
     * @param FactoryInterface $factory
     * @param RouterInterface $router
     */
    public function __construct(
        FactoryInterface $factory,
        RouterInterface $router
    ) {
        $this->factory = $factory;
        $this->router = $router;
    }

    /**
     * @param string $processPath
     * @return StateHandler
     */
    public function setProcessPath($processPath)
    {
        $this->processPath = $processPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcessPath()
    {
        return $this->processPath;
    }

    /**
     * @param string $actionPath
     * @return StateHandler
     */
    public function setActionPath($actionPath)
    {
        $this->actionPath = $actionPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionPath()
    {
        return $this->actionPath;
    }

    /**
     * @param string $responsePath
     * @return StateHandler
     */
    public function setResponsePath($responsePath)
    {
        $this->responsePath = $responsePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getResponsePath()
    {
        return $this->responsePath;
    }

    /**
     * @inheritdoc
     */
    public function handle(Request $request, StatefulInterface $object)
    {
        $process = $request->attributes->get($this->processPath, null, true);
        $action = $request->attributes->get($this->actionPath, null, true);
        $stateMachine = $this->factory->create($process, $object);

        if (!$stateMachine->hasToken($action)) {
            throw new HttpException(404, 'Action not found');
        }
        $response = $stateMachine->applyToken($action, $request);

        if (null === $response) {
            $response = $this->prepareResponse($request);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    protected function prepareResponse(Request $request)
    {
        $responseParams = $request->attributes->get($this->responsePath, array(), true);
        $url = null;

        if (is_array($responseParams) && count($responseParams) <= 2) {
            $name = $responseParams[0];
            $parameters = $responseParams[1];

            if (is_array($parameters)) {
                foreach ($parameters as $parameter => $value) {
                    $parameters[$parameter] = $this->parseRouteParameter(
                        $value,
                        $request
                    );
                }
            } else {
                $parameters = $this->parseRouteParameter($parameters, $request);
            }

            $url = $this->router->generate($name, $parameters);
        } elseif (is_string($responseParams)) {
            $url = $responseParams;
        } else {
            return null;
        }

        return new RedirectResponse($url);
    }

    /**
     * @param string $value
     * @param Request $request
     * @return mixed
     */
    protected function parseRouteParameter($value, Request $request)
    {
        if ('$' == $value{0}) {
            $value = $request->attributes->get(
                substr($value, 1)
            );
        }

        return $value;
    }
}
