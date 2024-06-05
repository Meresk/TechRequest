<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Models\Application $application
 */
?>

<?php $view->component('start'); ?>
    <main>
        <div class="container">
            <h3 class="mt-3">Подробности о заявке № <?php echo $application->id()?></h3>
            <hr>
        </div>
        <div class="container">
            <div class="card my-4">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3 text-right">Причина:</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($application->reason());?></dd>

                        <dt class="col-sm-3 text-right">Инвентарный номер:</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($application->inventoryNumber());?></dd>

                        <dt class="col-sm-3 text-right">Место инвентаризации:</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($application->inventoryPlace());?></dd>

                        <dt class="col-sm-3 text-right">Комментарий заявителя:</dt>
                        <dd class="col-sm-9"><?php echo nl2br(htmlspecialchars($application->applicantComment()));?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>