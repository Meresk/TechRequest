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

            <div class="card my-3 col-md-6">
                <h5 class="card-header">
                    Причина
                </h5>
                <div class="card-body">
                    <p class="card-title"><?php echo htmlspecialchars($application->reason());?></p>
                </div>
            </div>

            <div class="card my-3 col-md-6">
                <h5 class="card-header">
                    Инвентарный номер
                </h5>
                <div class="card-body">
                    <p class="card-title"><?php echo htmlspecialchars($application->inventoryNumber());?></p>
                </div>
            </div>

            <div class="card my-3 col-md-6">
                <h5 class="card-header ">
                    Место инвентаризации
                </h5>
                <div class="card-body">
                    <p class="card-title"><?php echo htmlspecialchars($application->inventoryPlace());?></p>
                </div>
            </div>

            <div class="card my-3 col-md-6">
                <h5 class="card-header">
                    Комментарий заявителя
                </h5>
                <div class="card-body">
                    <p class="card-title"><?php echo nl2br(htmlspecialchars($application->applicantComment()));?></p>
                </div>
            </div>

            <div class="card my-3 col-md-6">
                <h5 class="card-header">
                    Комментарий исполнителя
                </h5>
                <div class="card-body">
                    <p class="card-title"><?php echo nl2br(htmlspecialchars($application->applicantComment()));?></p>
                </div>
            </div>

            <div class="card my-3 col-md-6">
                <h5 class="card-header">
                    Причина закрытия
                </h5>
                <div class="card-body">
                    <p class="card-title"><?php echo nl2br(htmlspecialchars($assignment->closeReason()));?></p>
                </div>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>