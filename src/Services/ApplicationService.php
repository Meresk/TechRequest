<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Application;

class ApplicationService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    public function all(): array
    {
        $applications = $this->db->get('applications');

        return $this->toApplicationObject($applications);
    }

    /**
     * Возвращает массив а не объекты класса Application!
     */
    public function getApplicationsByUser(): array
    {
        $applications = $this->db->selectWithJoin(
            'applications.id',
            'assignments.application_id',
            ['applicant_id' => $_SESSION['user_id']]
        );

        return $applications;
    }

    public function store(string $reason, string $inventoryNumber, string $inventoryPlace, string $applicantComment): false|int
    {
        return $this->db->insert('applications', [
            'reason' => $reason,
            'applicant_id' => $_SESSION['user_id'],
            'inventory_Number' => $inventoryNumber,
            'inventory_Place' => $inventoryPlace,
            'applicant_Comment' => $applicantComment,
        ]);
    }

    public function delete(int $id): void
    {
        $this->db->delete('applications', ['id' => $id]);
    }

    public function update(int $id, string $reason, string $inventoryNumber, string $inventoryPlace, string $applicantComment): void
    {
        $this->db->update('applications', [
            'reason' => $reason,
            'inventory_number' => $inventoryNumber,
            'inventory_place' => $inventoryPlace,
            'applicant_comment' => $applicantComment,
        ], [
            'id' => $id,
        ]);
    }

    public function find(int $id): ?Application
    {
        $application = $this->db->first('applications', ['id' => $id]);

        if(!$application){
            return null;
        }

        return new Application(
            $application['id'],
            $application['applicant_id'],
            $application['status'],
            $application['reason'],
            $application['inventory_number'],
            $application['inventory_place'],
            $application['applicant_comment'],
            $application['executor_comment'],
            $application['date_submitted'],
            $application['created_at'],
            $application['updated_at'],
        );
    }

    /**
     * Метод преобразования массивов в объекты класса Application
     * @param array $applications
     * @return Application[]
     */
    public function toApplicationObject(array $applications): array
    {
        $applications = array_map(function ($application) {
            return new Application(
                id: $application['id'],
                applicantId: $application['applicant_id'],
                status: $application['status'],
                reason: $application['reason'],
                inventoryNumber: $application['inventory_number'],
                inventoryPlace: $application['inventory_place'],
                applicantComment: $application['applicant_comment'],
                executorComment: $application['executor_comment'],
                dateSubmitted: $application['date_submitted'],
                createdAt: $application['created_at'],
                updatedAt: $application['updated_at'],
            );
        }, $applications);

        return $applications;
    }
}