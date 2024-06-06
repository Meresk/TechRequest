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
            <h3 class="mt-3">Подробности о заявке № <?php echo $application->id() ?></h3>
            <hr>
        </div>
        <div class="container">
            <form action="/applications/update" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <input type="hidden" name="id" value="<?php echo $application->id() ?>">
                <div class="row g-2">
                    <!-- Поле "Причина" -->
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="reason" name="reason">
                                <option value="" selected disabled>Выберите причину</option>
                                <option value="поломка" <?php echo $application->reason() === 'поломка' ? 'selected' : ''; ?>>Поломка</option>
                                <option value="не корректная работа оборудования"
                                    <?php
                                        echo $application->reason() === 'не корректная работа оборудования' ? 'selected' : '';
                                    ?>>Не корректная работа оборудования</option>
                                <option value="техническое обслуживание"
                                    <?php
                                        echo $application->reason() === 'техническое обслуживание' ? 'selected' : '';
                                    ?>>Техническое обслуживание</option>
                            </select>
                            <label for="reason">Причина</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <!-- Поле "Инвентарный номер" -->
                    <div class="col-md">
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="inventoryNumber"
                                name="inventoryNumber"
                                placeholder="Инвентарный номер"
                                value="<?php echo $application->inventoryNumber(); ?>"
                            >
                            <label for="inventoryNumber">Инвентарный номер (при наличии)</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <!-- Поле "Место инвентаризации" -->
                    <div class="col-md">
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="inventoryPlace"
                                name="inventoryPlace"
                                placeholder="Расположение оборудования"
                                value="<?php echo $application->inventoryPlace()?>"
                            >
                            <label for="inventoryPlace">Место инвентаризации</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <!-- Поле "Комментарий заявителя" -->
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea
                                style="height: 190px; min-height: 100px; max-height: 330px"
                                class="form-control"
                                id="applicantComment"
                                name="applicantComment"
                                placeholder="Комментарий заявителя"
                            ><?php echo htmlspecialchars($application->applicantComment());?></textarea>
                            <label for="applicantComment">Комментарий заявителя</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <!-- Поле "Назначения исполнителя" -->
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea
                                    style="height: 190px; min-height: 100px; max-height: 330px"
                                    class="form-control"
                                    id="applicantComment"
                                    name="applicantComment"
                                    placeholder="Комментарий заявителя"
                            ><?php echo htmlspecialchars($application->applicantComment());?></textarea>
                            <label for="applicantComment">Комментарий заявителя</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <button class="btn btn-primary">Обновить</button>
                </div>

            </form>
        </div>
    </main>

<?php $view->component('end'); ?>