<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

     private $id;

     /**
      * @ORM\Column(type="string", length=255)
      */
     private $title;

     /**
      * @ORM\Column(type="text")
      */
     private $content;

     /**
      * @ORM\Column(type="datetime_immutable")
      */
     private $created_at;

     /**
      * @ORM\Column(type="datetime_immutable")
      */
     private $updated_at;

     /**
      * @ORM\Column(type="datetime_immutable", nullable=true)
      */
     private $completed_at;

     /**
      * @ORM\ManyToMany(targetEntity=User::class, inversedBy="task")
      */
     private $users;

     /**
      * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="tasks")
      */
     private $status;

     public function __construct()
     {
         $this->users = new ArrayCollection();
         $this->created_at = new \DateTimeImmutable();
         $this->updated_at = new \DateTimeImmutable();
     }

     public function getId(): ?int
     {
        return $this->id;
     }

     public function setId(int $id): self
     {
        $this-> id = $id;

        return $this;
     }

     public function getTitle(): ?string
     {
         return $this->title;
     }

     public function setTitle(string $title): self
     {
         $this->title = $title;

         return $this;
     }

     public function getContent(): ?string
     {
         return $this->content;
     }

     public function setContent(string $content): self
     {
         $this->content = $content;

         return $this;
     }

     public function getCreatedAt(): ?\DateTimeImmutable
     {
         return $this->created_at;
     }

     public function setCreatedAt(\DateTimeImmutable $created_at): self
     {
         $this->created_at = $created_at;

         return $this;
     }

     public function getUpdatedAt(): ?\DateTimeImmutable
     {
         return $this->updated_at;
     }
     
     public function setUpdatedAt(\DateTimeImmutable $updated_at): self
     {
        $this->updated_at = $updated_at;
     
         return $this;
     }

     public function getCompletedAt(): ?\DateTimeImmutable
     {
         return $this->completed_at;
     }

     public function setCompletedAt(?\DateTimeImmutable $completed_at): self
     {
         $this->completed_at = $completed_at;

         return $this;
     }

     /**
      * @return Collection<int, User>
      */
     public function getUsers(): Collection
     {
         return $this->users;
     }

     public function addUser(User $user): self
     {
         if (!$this->users->contains($user)) {
             $this->users[] = $user;
             $user->addTask($this);
         }

         return $this;
     }

     public function removeUser(User $user): self
     {
         if ($this->users->removeElement($user)) {
             $user->removeTask($this);
         }

         return $this;
     }

     public function getStatus(): ?Status
     {
         return $this->status;
     }

     public function setStatus(?Status $status): self
     {
         $this->status = $status;

         return $this;
     }
}