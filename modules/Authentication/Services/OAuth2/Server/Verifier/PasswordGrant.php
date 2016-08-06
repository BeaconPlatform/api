<?php

namespace Beacon\Api\Authentication\Services\OAuth2\Server\Verifier;

use Beacon\Api\Core\Exceptions\PersonNotAuthorizedException;
use Beacon\Api\Core\Exceptions\PersonNotFoundException;
use Beacon\Api\Core\Repositories\PersonRepositoryInterface;
use Illuminate\Validation\Factory as Validator;

class PasswordGrant
{
    /**
     * @var     Validator
     */
    protected $validator;

    /**
     * @var     PersonRepositoryInterface
     */
    protected $person;

    public function __construct(Validator $validator, PersonRepositoryInterface $person)
    {
        $this->validator    = $validator;
        $this->person       = $person;
    }

    /**
     * Verify user credentials.
     *
     * @param       string      $username
     * @param       string      $password
     * @return      boolean|\Beacon\Api\Core\Entities\Person
     */
    public function verify($username, $password)
    {
        $result     = false;
        $person     = $this->person->forUsername($username)
                                   ->validatePassword($password);

        // Check if email or username.
        $validator  = $this->validator->make(
            ['email'   => $username],
            ['email'   => 'email']
        );

        if (!$validator->fails()) {
            $person->forEmail($username)
                   ->forUsername(null);
        }

        try {
            if (($person = $person->retrieve()) !== null) {
                $result     = $person->uuid;
            }
        } catch (PersonNotAuthorizedException $e) {
            $result = false;
        } catch (PersonNotFoundException $e) {
            $result = false;
        }

        return $result;
    }
}
