<?php

namespace App\Entity;

use App\Repository\StudentcartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentcartRepository::class)
 */
class Studentcart
{


    /**
     * One Cart has One Student.
     * @ORM\OneToOne(targetEntity="App\Entity\Student", inversedBy="cart")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;
   // ....

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
