<?php

namespace App\Models;

class Application
{
    public function __construct(
        private int $id,
        private int $applicantId,
        private string $status,
        private string $reason,
        private ?string $inventoryNumber,
        private string $inventoryPlace,
        private ?string $applicantComment,
        private ?string $executorComment,
        private ?string $dateSubmitted,
        private string $createdAt,
        private string $updatedAt,
    )
    {
    }

    public static function createFromArray(array $data): self {
        return new self(
            id: $data['id'],
            applicantId: $data['applicant_id'],
            status: $data['status'],
            reason: $data['reason'],
            inventoryNumber: $data['inventory_number'],
            inventoryPlace: $data['inventory_place'],
            applicantComment: $data['applicant_comment'],
            executorComment: $data['executor_comment'],
            dateSubmitted: $data['date_submitted'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at']
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function applicantId(): string
    {
        return $this->applicantId;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function reason(): string
    {
        return $this->reason;
    }

    public function inventoryNumber(): string
    {
        return $this->inventoryNumber;
    }

    public function inventoryPlace(): string
    {
        return $this->inventoryPlace;
    }

    public function applicantComment(): string
    {
        return $this->applicantComment;
    }

    public function executorComment(): string
    {
        return $this->executorComment;
    }

    public function dateSubmitted(): string
    {
        return $this->dateSubmitted;
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