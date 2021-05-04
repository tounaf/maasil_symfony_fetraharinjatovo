<?php
/**
 * Created by PhpStorm.
 * User: nambinina2
 * Date: 04/05/2021
 * Time: 08:26
 */

namespace App\Listener;


use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->passwordEncoder = $userPasswordEncoder;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getObject();
        if (!($entity instanceof User)) {
            return;
        }
        $entity->setPassword($this->passwordEncoder->encodePassword($entity, $entity->getPassword()));
    }
}