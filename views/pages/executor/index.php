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
        <h3 class="mt-3">Исполение заявок</h3>
        <hr>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4>Заявки, на которые вы назначены</h4>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Статус</th>
                <th scope="col">ФИО заявителя</th>
                <th scope="col">Причина</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($applications as $application) { // Используем ссылку для изменения оригинальных данных
                    foreach ($users as $applicant) {
                        if ($application['applicant_id'] == $applicant->id()) {
                            $view->component('executor/application', ['application' => $application, 'applicant' => $applicant]);
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php $view->component('end'); ?>