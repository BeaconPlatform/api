<?php namespace Beacon\Api\Core\Repositories;

interface PersonRepositoryInterface
{
    /**
     * Find by email.
     *
     * @param       string      $email
     * @return      PersonRepositoryInterface
     */
    public function forEmail($email);

    /**
     * Find by username.
     *
     * @param       string      $username
     * @return      PersonRepositoryInterface
     */
    public function forUsername($username);

    /**
     * Validate by password.
     *
     * @param       string      $password
     * @return      PersonRepositoryInterface
     */
    public function validatePassword($password);

    /**
     * Retrieves a Person record.
     *
     * @return      \Beacon\Api\Core\Entities\Person
     * @throws      \Beacon\Api\Core\Exceptions\PersonNotFoundException|
     *              \Beacon\Api\Core\Exception\PersonNotAuthorizedException
     */
    public function retrieve();
}
