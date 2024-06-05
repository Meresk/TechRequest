<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>

<?php $view->component('start'); ?>
    <main>
        <div class="container">
            <h3 class="mt-3">Открытие новой заявки</h3>
            <hr>
        </div>
        <div class="container">
            <form action="/applications/add" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <div class="row g-2">
                    <!-- Поле "Причина" -->
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="reason" name="reason">
                                <option value="" selected disabled>Выберите причину</option>
                                <option value="поломка">Поломка</option>
                                <option value="не корректная работа оборудования">Не корректная работа оборудования</option>
                                <option value="техническое обслуживание">Техническое обслуживание</option>
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
                            ></textarea>
                            <label for="applicantComment">Комментарий заявителя</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <button class="btn btn-primary">Добавить</button>
                </div>

            </form>
        </div>
    </main>

<?php $view->component('end'); ?>