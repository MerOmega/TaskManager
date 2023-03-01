<?php

namespace App\Entity;

use App\Repository\TaskStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskStatusRepository::class)]
class TaskStatus
{

    const STATUS_TO_START = 'to start';
    const STATUS_IN_PROGRESS = 'in progress';
    const STATUS_FINISHED = 'finished';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'taskStatus', targetEntity: Task::class, orphanRemoval: true)]
    private Collection $task;

    public function __construct(string $status)
    {
        if (!in_array($status, [self::STATUS_TO_START, self::STATUS_IN_PROGRESS, self::STATUS_FINISHED])) {
            throw new \InvalidArgumentException("Invalid status value '$status'");
        }

        $this->status = $status;
        $this->task = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }


    /**Use to add new status like abandoned
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTask(): Collection
    {
        return $this->task;
    }

    public function addTask(Task $task): self
    {
        if (!$this->task->contains($task)) {
            $this->task->add($task);
            $task->setTaskStatus($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->task->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getTaskStatus() === $this) {
                $task->setTaskStatus(null);
            }
        }

        return $this;
    }
}
