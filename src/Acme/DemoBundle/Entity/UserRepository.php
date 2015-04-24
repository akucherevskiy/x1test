<?php
namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findActiveUsers()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM AcmeDemoBundle:User u WHERE u.userStatus = :userStatus ORDER BY u.userId ASC'
            )->setParameter('userStatus', User::STATUS_ACTIVE)
            ->getResult();
    }
}