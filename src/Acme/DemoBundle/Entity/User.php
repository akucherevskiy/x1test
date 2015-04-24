<?php
namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
    const STATUS_ACTIVE = 0;
    const STATUS_INACTIVE = 1;
    const STATUS_BLOCKED = 2;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $userId;

    /**
     * @ORM\Column(type="integer")
     */
    public $userStatus;

    public function setUserStatus($status) {
        $this->userStatus = $status;
    }

    public function getUserStatus(){
        return $this->userStatus;
    }

    public function getUserId(){
        return $this->userId;
    }
}