<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Models\Application $application
 * @var \App\Models\Assignment $assignment
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
                <div class="col-md-6 ">
                    <div class="card my-3">
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

                    <div class="card my-3">
                        <h5 class="card-header ">
                            Место инвентаризации
                        </h5>
                        <div class="card-body">
                            <p class="card-title"><?php echo htmlspecialchars($application->inventoryPlace()); ?></p>
                        </div>
                    </div>

                    <div class="card my-3">
                        <h5 class="card-header">
                            Комментарий заявителя
                        </h5>
                        <div class="card-body">
                            <p class="card-title"><?php echo nl2br(htmlspecialchars($application->applicantComment())); ?></p>
                        </div>
                    </div>
                </div>

                <?php if ($assignment != null) { ?>
                    <div class="col-md-4 border-start border-warning">

                        <div class="card my-3">
                            <h5 class="card-header">
                                Дата открытия заявки
                            </h5>
                            <div class="card-body">
                                <p class="card-title"><?php echo nl2br(htmlspecialchars($application->createdAt())); ?></p>
                            </div>
                        </div>

                        <?php if ($assignment->dateStartedWork() != null) { ?>
                            <div class="card my-3">
                                <h5 class="card-header">
                                    Дата начала работы
                                </h5>
                                <div class="card-body">
                                    <p class="card-title"><?php echo nl2br(htmlspecialchars($assignment->dateStartedWork())); ?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($assignment->dateEndedWork() != null) { ?>
                            <div class="card my-3">
                                <h5 class="card-header">
                                    Дата окончания работы
                                </h5>
                                <div class="card-body">
                                    <p class="card-title"><?php echo nl2br(htmlspecialchars($assignment->dateEndedWork())); ?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($assignment->closeReason() != null) { ?>
                            <div class="card my-3">
                                <h5 class="card-header">
                                    Причина закрытия
                                </h5>
                                <div class="card-body">
                                    <p class="card-title"><?php echo nl2br(htmlspecialchars($assignment->closeReason())); ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>