<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Embedded(class="App\Entity\UserData", columnPrefix = false)
     */
    private $userData;

    /** @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="attending") */
    private $attendingEvents;

    /** @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="owner") */
    private $ownedEvents;


}
