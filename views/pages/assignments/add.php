<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 *
 * @var \App\Models\Application $application
 * @var array<\App\Models\User> $executors
 * @var \App\Models\Assignment|null $assignment
 */
?>

<?php $view->component('start'); ?>
    <main>
        <div class="container">
            <h3 class="mt-3">Подробности о заявке № <?php echo $application->id() ?></h3>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6 border-end border-warning ">
                    <div class="card my-3 ">
                        <h5 class="card-header">
                            Причина
                        </h5>
                        <div class="card-body">
                            <p class="card-title"><?php echo htmlspecialchars($application->reason()); ?></p>
                        </div>
                    </div>

                    <div class="card my-3">
                        <h5 class="card-header">
                            Инвентарный номер
                        </h5>
                        <div class="card-body">
                            <p class="card-title"><?php echo htmlspecialchars($application->inventoryNumber()); ?></p>
                        </div>
                    </div>

                    <div class="card my-3 ">
                        <h5 class="card-header ">
                            Место инвентаризации
                        </h5>
                        <div class="card-body">
                            <p class="card-title"><?php echo htmlspecialchars($application->inventoryPlace()); ?></p>
                        </div>
                    </div>

                    <div class="card my-3 ">
                        <h5 class="card-header">
                            Комментарий заявителя
                        </h5>
                        <div class="card-body">
                            <p class="card-title"><?php echo nl2br(htmlspecialchars($application->applicantComment())); ?></p>
                        </div>
                    </div>

                </div>

                <div class="col-md-5 my-3">
                    <div class="card">
                        <h5 class="card-header">
                            Назначить исполнителя
                        </h5>
                        <div class="card-body">
                            <?php if (!is_null($assignment)) { ?>
                                <form action="/assignments/add" method="post">
                                    <input type="hidden" name="id" value="<?php echo $assignment->id() ?>">
                                    <input type="hidden" name="applicationId" value="<?php echo $application->id() ?>">
                                    <div class="mb-2">
                                        <select class="form-select " name="executorId">
                                            <option value="" selected disabled>Выберите исполнителя</option>
                                            <?php foreach ($executors as $executor) { ?>
                                                <option value="<?php echo $executor->id() ?>" <?php echo $executor->id() == $assignment->executorId() ? 'selected' : '' ?>>
                                                    <?php echo $executor->name() ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-0 d-flex justify-content-end">
                                        <button class="btn btn-primary btn-success">Назначить</button>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <form action="/assignments/add" method="post">
                                    <input type="hidden" name="applicationId" value="<?php echo $application->id() ?>">
                                    <div class="mb-2">

                                        <select class="form-select " name="executorId" id="executorSelect">
                                            <option value="" selected disabled>Выберите исполнителя</option>
                                            <?php foreach ($executors as $executor) { ?>
                                                <option value="<?php echo $executor->id() ?>">
                                                    <?php echo $executor->name() ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-0 d-flex justify-content-end">
                                        <button class="btn btn-primary btn-success" id="assignButton" disabled>Назначить</button>
                                    </div>

                                    <script>
                                        document.getElementById('executorSelect').addEventListener('change', function() {
                                            var assignButton = document.getElementById('assignButton');
                                            if (this.value !== "") {
                                                assignButton.removeAttribute('disabled');
                                            } else {
                                                assignButton.setAttribute('disabled', 'disabled');
                                            }
                                        });
                                    </script>
                                </form>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if (!is_null($assignment)) { ?>

                        <div class="card my-3">
                            <h5 class="card-header">
                                Комментарий исполнителя
                            </h5>
                            <div class="card-body">
                                <p class="card-title"><?php echo $assignment->executorComment() != null ? $assignment->executorComment() : 'Отсуствует' ?></p>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>