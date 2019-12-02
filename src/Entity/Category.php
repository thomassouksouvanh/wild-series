<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    private $categoryName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Program", mappedBy="category")
     */
    private $programs;

    /**
     * @return int|null
     * @var Category|null
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getCategory(): ?Category
    {
        return $this->categoryName;
    }

    public function setCategory(?Category $categoryName): self
    {
        return $this->categoryName;
    }

    public function __construct()
    {
        $this->programs = new ArrayCollection();
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    /**
     * param Program $program
     * @param Program $program
     * @return Category
     */
    public function addProgram(Program $program): self
    {
        if(!$this->programs->contains($program)){
            $this->programs[] = $program;
            $program->setCategory($this);
        }
        return $this;
    }

    /**
     * param Program $program
     * @param Program $program
     * @return $this
     */
    public function removeProgram(Program $program): self
    {
        if ($this->programs->contains($program)){
            $this->programs->removeElement($program);
            // set the owning side to null (unless already changed)
            if($program->getCategory() === $this){
                $program->setCategory(null);
            }
            return $this;
        }
    }
}
