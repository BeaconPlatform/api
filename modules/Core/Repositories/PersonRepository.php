<?php namespace Beacon\Api\Core\Repositories;

use Beacon\Api\Core\Entities\Person;
use Beacon\Api\Core\Exceptions\PersonNotAuthorizedException;
use Beacon\Api\Core\Exceptions\PersonNotFoundException;
use Illuminate\Hashing\BcryptHasher as Hash;

class PersonRepository implements PersonRepositoryInterface
{
    /**
     * @var     Hash
     */
    protected $hash;

    /**
     * @var     string
     */
    protected $email;

    /**
     * @var     string
     */
    protected $username;

    /**
     * @var     string|null|boolean
     */
    protected $password     = false;

    public function __construct(Hash $hash)
    {
        $this->hash         = $hash;
    }

    /**
     * @inheritdoc
     */
    public function forEmail($email)
    {
        $this->email        = $email;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function forUsername($username)
    {
        $this->username     = $username;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function validatePassword($password)
    {
        $this->password     = (string) $password;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function retrieve()
    {
        $person     = Person::limit(1);

        $needles    = array_where(
            [
                'username'      => $this->username,
                'email'         => $this->email
            ],
            function ($key, $value) {
                return !empty($value);
            }
        );

        array_walk(
            $needles,
            function ($value, $key) use (&$person) {
                $person->where($key, '=', $value);
            }
        );

        $person     = $person->first();
        
        if (empty($person)) {
            throw new PersonNotFoundException;
        }

        // Check the password.
        if ($this->password !== false && $this->hash->check($this->password, $person->password) === false) {
            throw new PersonNotAuthorizedException;
        }
        
        return $person;
    }
}
