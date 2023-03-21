<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
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
     private $label;

     /**
      * @ORM\OneToMany(targetEntity=Task::class, mappedBy="status")
      */
     private $tasks;

     public function __construct()
     {
         $this->tasks = new ArrayCollection();
     }

     public function getLabel(): ?string
     {
         return $this->label;
     }

     public function setLabel(string $label): self
     {
         $this->label = $label;

         return $this;
     }

     /**
      * @return Collection<int, Task>
      */
     public function getTasks(): Collection
     {
         return $this->tasks;
     }

     public function addTask(Task $task): self
     {
         if (!$this->tasks->contains($task)) {
             $this->tasks[] = $task;
             $task->setStatus($this);
         }

         return $this;
     }

     public function removeTask(Task $task): self
     {
         if ($this->tasks->removeElement($task)) {
             // set the owning side to null (unless already changed)
             if ($task->getStatus() === $this) {
                 $task->setStatus(null);
             }
         }

         return $this;
     }
}