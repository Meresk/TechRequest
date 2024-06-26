<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Application;
use App\Models\Assignment;
use App\Models\Role;

class AssignmentService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    public function all(): array
    {
        $assignments = $this->db->get('assignments');

        $assignments = array_map(function ($assignment) {
            return new Assignment(
                assignmentId: $assignment['assignment_id'],
                applicationId: $assignment['application_id'],
                executorId: $assignment['executor_id'],
                dateStartedWork: $assignment['date_started_work'],
                dateEndedWork: $assignment['date_ended_work'],
                executorComment: $assignment['executor_comment'],
                closeReason: $assignment['close_reason'],
                createdAt: $assignment['created_at'],
                updatedAt: $assignment['updated_at'],
            );
        }, $assignments);

        return $assignments;
    }

    public function upsert(?int $id, int $applicationId, int $executorId): false|int
    {
        if($this->db->first('assignments', ['assignment_id' => $id]) == null){
            return $this->db->insert('assignments', ['application_id' => $applicationId, 'executor_id' => $executorId]);
        } else {
            $this->db->update('assignments', [
                'application_id' => $applicationId,
                'executor_id' => $executorId,
            ], [
                'assignment_id' => $id,
            ]);
            return true;
        }
    }

    public function findApplication(int $id): ?Application
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
            $application['date_submitted'],
            $application['created_at'],
            $application['updated_at'],
        );
    }

    public function findAssignment(int $applicationId): ?Assignment
    {
        $assignment = $this->db->first('assignments', ['application_id' => $applicationId]);

        if(!$assignment){
            return null;
        }

        return new Assignment(
            $assignment['assignment_id'],
            $assignment['application_id'],
            $assignment['executor_id'],
            $assignment['date_started_work'],
            $assignment['date_ended_work'],
            $assignment['executor_comment'],
            $assignment['close_reason'],
            $assignment['created_at'],
            $assignment['updated_at'],
        );
    }
}