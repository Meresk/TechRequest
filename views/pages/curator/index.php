<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array<\App\Models\Application> $applications
 * @var array<\App\Models\User> $users
 * @var array<\App\Models\Assignment> $assignments
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
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($applications as $application) {
                    foreach ($users as $user) {
                        if ($application->applicantId() == $user->id())
                            $view->component('curator/application', ['application' => $application, 'user' => $user]);
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php $view->component('end'); ?>