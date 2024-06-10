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
                    <form action="/executor/applications/work" method="post">
                        <input type="hidden" name="applicationId" value="<?php echo $application->id() ?>">
                        <div class="card">
                            <h5 class="card-header">
                                Статус
                            </h5>
                            <div class="card-body">
                                <div class="mb-2">
                                    <select class="form-select " id="statusSelect" name="status">
                                        <?php
                                        $statusOptions = ['принята в работу', 'в работе', 'закрыта'];
                                        foreach ($statusOptions as $option) {
                                            $selected = ($application->status() === $option) ? 'selected' : '';
                                            echo "<option value=\"$option\" $selected>$option</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card my-3" id="closeReasonInput" style="display:block;">
                            <h5 class="card-header">
                                Причина закрытия
                            </h5>
                            <div class="card-body">
                                <textarea
                                        style="height: 100px; min-height: 100px; max-height: 330px"
                                        class="form-control"
                                        id="closeReason"
                                        name="closeReason"></textarea>
                            </div>
                        </div>

                        <div class="card my-3 ">
                            <h5 class="card-header">
                                Комментарий к заявке:
                            </h5>
                            <div class="card-body">
                                <textarea
                                        style="height: 190px; min-height: 100px; max-height: 330px"
                                        class="form-control"
                                        id="executorComment"
                                        name="executorComment"><?php echo $assignment->executorComment(); ?></textarea>
                            </div>
                        </div>

                        <div class="mb-0 d-flex justify-content-end">
                            <button id="submitBtn" class="btn btn-primary btn-success">Сохранить</button>
                        </div>

                        <script>
                            // Получаем элементы DOM
                            const statusSelect = document.getElementById('statusSelect');
                            const closeReasonInput = document.getElementById('closeReasonInput');
                            const closeReasonTextarea = document.querySelector('#closeReasonInput textarea');
                            const submitBtn = document.getElementById('submitBtn');

                            // Функция обновления состояния элементов в зависимости от выбранного статуса
                            function updateElements() {
                                if (statusSelect.value === 'закрыта') {
                                    closeReasonInput.style.display = 'block';

                                    if (closeReasonTextarea.value.trim() === '') {
                                        submitBtn.disabled = true;
                                    } else {
                                        submitBtn.disabled = false;
                                    }
                                } else {
                                    closeReasonInput.style.display = 'none';
                                    submitBtn.disabled = false;
                                }
                            }

                            // Обновляем элементы при изменении значения в statusSelect
                            statusSelect.addEventListener('change', updateElements);

                            // Обновляем элементы при вводе в поле closeReasonTextarea
                            closeReasonTextarea.addEventListener('input', updateElements);

                            // Инициализация состояния элементов
                            updateElements();
                        </script>

                    </form>
                </div>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>