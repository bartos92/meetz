<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class UserData
{

    /** @ORM\Column(type="string") */
    private $firstName = '';

    public function getFirstName() { return $this->firstName; }
    public function setFirstName($firstName) { $this->firstName = $firstName; }

    /** @ORM\Column(type="string") */
    private $lastName = '';
    public function getLastName() { return $this->lastName; }
    public function setLastName($lastName) { $this->lastName = $lastName; }

    public function getFullName()
    {
        return "$this->firstName $this->lastName";
    }

    /** @ORM\Column(type="string") */
    private $nickname = '';

    public function __construct($firstName, $lastName, $nickname)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->nickname = $nickname;
    }
}
