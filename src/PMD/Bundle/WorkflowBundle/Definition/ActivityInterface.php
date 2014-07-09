<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Definition;

use Doctrine\Common\Collections\Collection;

/**
 * Interface ActivityInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Definition
 */
interface ActivityInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param Collection|TransitionInterface[] $transitions
     * @return ActivityInterface
     */
    public function setInputTransitions(Collection $transitions);

    /**
     * @param TransitionInterface $transition
     * @return ActivityInterface
     */
    public function addInputTransition(TransitionInterface $transition);

    /**
     * @return Collection|TransitionInterface[]
     */
    public function getInputTransitions();

    /**
     * @param Collection|TransitionInterface[] $transitions
     * @return ActivityInterface
     */
    public function setOutputTransitions(Collection $transitions);

    /**
     * @param TransitionInterface $transition
     * @return ActivityInterface
     */
    public function addOutputTransition(TransitionInterface $transition);

    /**
     * @return Collection|TransitionInterface[]
     */
    public function getOutputTransitions();
}
