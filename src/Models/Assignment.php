<?php

namespace App\Models;

class Assignment
{
    public function __construct(
        private int $assignmentId,
        private int $applicationId,
        private int $executorId,
        private ?string $dateStartedWork,
        private ?string $dateEndedWork,
        private ?string $closeReason,
        private string $createdAt,
        private string $updatedAt,
    )
    {
    }

    public function id(): int
    {
        return $this->assignmentId;
    }

    public function applicationId(): int
    {
        return $this->applicationId;
    }

    public function executorId(): int
    {
        return $this->executorId;
    }

    public function dateStartedWork(): string
    {
        return $this->dateStartedWork;
    }

    public function dateEndedWork(): string
    {
        return $this->dateEndedWork;
    }

    public function closeReason(): string
    {
        return $this->closeReason;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }
}