<?php
/**
 * Created by PhpStorm.
 * User: iPwne
 * Date: 10/01/2018
 * Time: 18:28
 */

namespace App\Listener\Entity;


use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    /** @ORM\PrePersist()
     * @param User $user
     * @param LifecycleEventArgs $event
     */
    public function prePersistHandler(User $user, LifecycleEventArgs $event)
    {
        if($user->getPlainPassword() !== null)
        {
            $encodedPassword = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encodedPassword);
        }
    }
}