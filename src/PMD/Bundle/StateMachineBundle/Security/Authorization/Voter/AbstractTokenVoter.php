<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as SecurityToken;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use PMD\StateMachineBundle\Behavior\AbstractConfigurableBehavior;
use PMD\StateMachineBundle\Behavior\Resolver\TokenOptionsResolverInterface;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class AbstractTokenVoter
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Security\Authorization\Voter
 */
abstract class AbstractTokenVoter extends AbstractConfigurableBehavior implements VoterInterface
{
    const VIEW = 'view';
    const CREATE = 'create';
    const CONSUME = 'consume';

    /**
     * @var TokenOptionsResolverInterface
     */
    protected $resolver;

    /**
     * @inheritdoc
     */
    public function supportsAttribute($attribute)
    {
        return in_array(
            $attribute,
            array(
                self::VIEW,
                self::CREATE,
                self::CONSUME,
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function supportsClass($class)
    {
        $supportedInterface = 'PMD\StateMachineBundle\Process\TokenInterface';
        $refClass = new \ReflectionClass($class);

        return $refClass->implementsInterface($supportedInterface);
    }

    /**
     * @inheritdoc
     */
    public function vote(SecurityToken $token, $object, array $attributes)
    {
        if (!$this->supportsClass(get_class($object))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        if (1 !== count($attributes)) {
            throw new InvalidArgumentException(
                'Only one attribute is allowed for VIEW, CREATE or CONSUME'
            );
        }

        $attribute = $attributes[0];

        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        /** @var TokenInterface $object */
        if (!$this->isEnabled($object)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        return $this->postVote($token, $object, $attributes);
    }

    /**
     * @param SecurityToken $token
     * @param TokenInterface $object
     * @param array $attributes
     * @return int
     */
    abstract protected function postVote(
        SecurityToken $token,
        TokenInterface $object,
        array $attributes
    );
}
