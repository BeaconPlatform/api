<?php

namespace Beacon\Api\Auth\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;

/**
 * @ORM\Entity()
 */
class Person implements HasRolesContract
{
    use HasRoles;
    use HasPermissions;

    /**
     * @var string
     */
    public $inversedBy = 'person';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    public function getRoles()
    {
        return $this->roles;
    }
}