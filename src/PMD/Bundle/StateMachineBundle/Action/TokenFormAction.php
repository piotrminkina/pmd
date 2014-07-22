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
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Templating\EngineInterface;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class TokenFormAction
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Action
 */
class TokenFormAction extends AbstractTokenAction
{
    /**
     * @var FormFactoryInterface
     */
    protected $factory;

    /**
     * @var EngineInterface
     */
    protected $engine;

    /**
     * @param FormFactoryInterface $factory
     * @param EngineInterface $engine
     */
    public function __construct(
        FormFactoryInterface $factory,
        EngineInterface $engine
    ) {
        $this->factory = $factory;
        $this->engine = $engine;
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'form_options' => array(),
            )
        );
        /* Currently is conflicted with option enabled
        $resolver->setRequired(
            array('form_type', 'form_view')
        );
        */
        $resolver->setOptional(
            array('form_options', 'form_type', 'form_view') // Last two will be removed when conflicts will be resolved
        );
        $resolver->setAllowedTypes(
            array(
                'form_type' => 'string',
                'form_view' => 'string',
                'form_options' => 'array'
            )
        );
    }

    /**
     * @inheritdoc
     */
    protected function postExecute(
        TokenInterface $token,
        Request $request
    ) {
        $options = $this->getOptions($token);
        $object = $token->getContext();

        $form = $this->factory->create(
            $options['form_type'],
            $object,
            $options['form_options']
        );
        $form->handleRequest($request);

        if ($form->isValid()) {
            return null;
        }

        return new Response(
            $this->engine->render(
                $options['form_view'],
                array(
                    'object' => $object,
                    'form' => $form->createView(),
                )
            )
        );
    }
}
