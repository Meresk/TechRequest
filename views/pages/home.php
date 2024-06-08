<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array $applications
 * @var \App\Models\User $executors
 */
?>

<?php $view->component('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3">Главная</h3>
        <hr>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4>Заявки</h4>
            <a href="/applications/add" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                <span>Добавить</span>
            </a>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Статус</th>
                <th scope="col">ФИО исполнителя</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($applications as &$application) { // Используем ссылку для изменения оригинальных данных
                    $executor = null;

                    foreach ($executors as $executorObj) {
                        if ($application['executor_id'] == $executorObj->id()) {
                            $executor = $executorObj;
                            break; // Выходим из внутреннего цикла, так как нашли нужного исполнителя
                        }
                    }
                    $view->component('application', ['application' => $application, 'executor' => $executor]);
                }
                unset($application); // Освобождаем ссылку на последнее значение
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php $view->component('end'); ?>