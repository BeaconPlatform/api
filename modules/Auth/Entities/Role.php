<?php

namespace Beacon\Api\Auth\Entities;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Contracts\Role as RoleContract;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use Doctrine\Common\Collections\ArrayCollection;
use LaravelDoctrine\ACL\Contracts\Permission;

/**
 * @ORM\Entity()
 */
class Role implements RoleContract
{
    use HasPermissions;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ACL\HasPermissions()
     */
    protected $permissions;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}