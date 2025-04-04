<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Core\Validator\Constraints;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UserPasswordValidator extends ConstraintValidator
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private PasswordHasherFactoryInterface $hasherFactory,
    ) {
    }

    public function validate(mixed $password, Constraint $constraint): void
    {
        if (!$constraint instanceof UserPassword) {
            throw new UnexpectedTypeException($constraint, UserPassword::class);
        }

        if (null === $password || '' === $password) {
            $this->context->buildViolation($constraint->message)
                ->setCode(UserPassword::INVALID_PASSWORD_ERROR)
                ->addViolation();

            return;
        }

        if (!\is_string($password)) {
            throw new UnexpectedTypeException($password, 'string');
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if (!$user instanceof PasswordAuthenticatedUserInterface) {
            throw new ConstraintDefinitionException(\sprintf('The "%s" class must implement the "%s" interface.', get_debug_type($user), PasswordAuthenticatedUserInterface::class));
        }

        $hasher = $this->hasherFactory->getPasswordHasher($user);

        if (null === $user->getPassword() || !$hasher->verify($user->getPassword(), $password, $user instanceof LegacyPasswordAuthenticatedUserInterface ? $user->getSalt() : null)) {
            $this->context->buildViolation($constraint->message)
                ->setCode(UserPassword::INVALID_PASSWORD_ERROR)
                ->addViolation();
        }
    }
}
