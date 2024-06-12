<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array $applications
 * @var array<\App\Models\User> $users
 * @var $sortBy
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
                <th scope="col"><a href="/curator?sortBy=id">ID</a></th>
                <th scope="col"><a href="/curator?sortBy=status">Статус</a></th>
                <th scope="col">Заявитель</th>
                <th scope="col"><a href="/curator?sortBy=reason">Причина</a></th>
                <th scope="col">Исполнитель</th>
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


            usort($applications, function ($a, $b) use ($sortBy) {
                $order = [
                    'не корректная работа оборудования' => 1,
                    'поломка' => 2,
                    'техническое обслуживание' => 3
                ];

                if ($sortBy === 'status') {
                    $statusOrder = ['открыта', 'принята в работу', 'в работе', 'закрыта'];

                    // Получаем индексы статусов в порядке сортировки
                    $statusIndexA = array_search($a['status'], $statusOrder);
                    $statusIndexB = array_search($b['status'], $statusOrder);

                    // Сортируем с учетом порядка статусов
                    if ($statusIndexA === false) $statusIndexA = PHP_INT_MAX;  // Помещаем неизвестные статусы в конец
                    if ($statusIndexB === false) $statusIndexB = PHP_INT_MAX;

                    return $statusIndexA - $statusIndexB;
                }

                if ($sortBy === 'reason') {
                    $reasonIndexA = $order[$a['reason']] ?? PHP_INT_MAX;
                    $reasonIndexB = $order[$b['reason']] ?? PHP_INT_MAX;

                    return $reasonIndexA - $reasonIndexB;
                }

                // По умолчанию сортируем по id
                return $a['id'] - $b['id'];
            });

            foreach ($applications as $application) {
                // Получаем пользователя-заявителя по ID, если он существует
                $applicantUser = isset($usersById[$application['applicant_id']]) ? $usersById[$application['applicant_id']] : null;

                // Получаем пользователя-исполнителя по ID, если он существует
                $executorUser = isset($usersById[$application['executor_id']]) ? $usersById[$application['executor_id']] : null;

                // Проверяем, есть ли исполнитель
                $hasExecutor = $executorUser !== null;

                $view->component('curator/application', [
                    'application' => $application,
                    'applicantUser' => $applicantUser,
                    'executorUser' => $hasExecutor ? $executorUser : null,
                ]);
            }
            ?>
            </tbody>
        </table>
    </div>
</main>

<?php $view->component('end'); ?>