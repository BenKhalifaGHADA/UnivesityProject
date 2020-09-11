<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @ORM\Table(name="Student")
 */
class Student
{
    /**
     *Many Students have many clubs
     * @ORM\ManyToMany (targetEntity="App\Entity\Club",inversedBy="students")
     * @ORM\JoinTable(
     *     joinColumns={@ORM\JoinColumn(onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE")}
     * )
     */
    private  $clubs;
    /**
     * Many Students have Many Projects.
     * @ORM\ManyToMany(targetEntity="App\Entity\Project")
     * @ORM\JoinTable(name="students_projects",
     *      joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")}
     *      )
     */
    private $projects;

    public function __construct()
    {
        $this->clubs=new ArrayCollection();
        $this->phonenumbers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->books = new ArrayCollection();

    }


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AcademicHome")
     * @ORM\JoinColumn(name="academichome_id", referencedColumnName="id")
     */
    private $home;

    /**
     * Many Student have Many Phonenumbers.
     * @ORM\ManyToMany(targetEntity="App\Entity\Phonenumber")
     * @ORM\JoinTable(name="student_phonenumbers",
     *      joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="phonenumber_id", referencedColumnName="id", unique=true)}
     *      )
     */

    private $phonenumbers;


    /**
     * One Student has One Cart.
     * @ORM\OneToOne(targetEntity="App\Entity\Studentcart",
     * mappedBy="student")
     */
    private $cart;




    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adress",
     *     mappedBy="student")
     */
    private $adresse;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classroom",
     *      inversedBy="students")
     */
    private $classroom;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")

     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\Column(name="email",type="string",length=255,unique=true, nullable= false)
     */
    private $lastname;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="students")
     */
    private $books;

    /**
     * @ORM\Column(type="date")
     */
    private $dateofbirth;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getAdresse(): ?Adress
    {
        return $this->adresse;
    }

    public function setAdresse(?Adress $adresse): self
    {
        $this->adresse = $adresse;

        // set (or unset) the owning side of the relation if necessary
        $newStudent = null === $adresse ? null : $this;
        if ($adresse->getStudent() !== $newStudent) {
            $adresse->setStudent($newStudent);
        }

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
        }

        return $this;
    }

    public function getDateofbirth(): ?\DateTimeInterface
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth(\DateTimeInterface $dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }
    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
        }

        return $this;
    }
    public function removeClub(Club $club): self
    {
        if ($this->clubs->contains($club)) {
            $this->clubs->removeElement($club);
        }

        return $this;
    }



}
