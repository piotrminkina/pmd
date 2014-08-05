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

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as SecurityToken;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class TokenRoleVoter
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Security\Authorization\Voter
 */
class TokenRoleVoter extends AbstractTokenVoter
{
    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'view' => array(),
                'create' => array(),
                'consume' => array(),
            )
        );

        $resolver->setAllowedTypes(
            array(
                'view' => 'array',
                'create' => 'array',
                'consume' => 'array',
            )
        );
    }

    /**
     * @inheritdoc
     */
    protected function postVote(
        SecurityToken $token,
        TokenInterface $object,
        array $attributes
    ) {
        $attribute = $attributes[0];
        $user = $token->getUser();
        $options = $this->getOptions($object);
        $roles = $options[$attribute];

        if (!$roles) {
            return VoterInterface::ACCESS_GRANTED;
        }

        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        foreach ($user->getRoles() as $role) {
            if (in_array($role->getRole(), $roles)) {
                return VoterInterface::ACCESS_GRANTED;
            }
        }

        return VoterInterface::ACCESS_DENIED;
    }
}
