<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array $applications
 * @var array<\App\Models\User> $users
 */
?>

<?php $view->component('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3">Управление заявками</h3>
        <hr>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4>Все заявки</h4>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Статус</th>
                <th scope="col">ФИО заявителя</th>
                <th scope="col">Причина</th>
                <th scope="col">ФИО исполнителя</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Создаем ассоциативный массив пользователей для быстрого доступа
            $usersById = [];
            foreach ($users as $user) {
                $usersById[$user->id()] = $user;
            }

            foreach ($applications as $application) {
                // Получаем пользователя-заявителя по ID, если он существует
                $applicantUser = isset($usersById[$application['applicant_id']])? $usersById[$application['applicant_id']] : null;

                // Получаем пользователя-исполнителя по ID, если он существует
                $executorUser = isset($usersById[$application['executor_id']])? $usersById[$application['executor_id']] : null;

                // Проверяем, есть ли исполнитель
                $hasExecutor = $executorUser!== null;

                $view->component('curator/application', [
                    'application' => $application,
                    'applicantUser' => $applicantUser,
                    'executorUser' => $hasExecutor? $executorUser : null
                ]);
            }
            ?>
            </tbody>
        </table>
    </div>
</main>

<?php $view->component('end'); ?>