document.addEventListener('DOMContentLoaded', function () {
    // Получаем текущий путь
    var currentPath = window.location.pathname;

    // Находим все пункты меню
    var navItems = document.querySelectorAll('.nav li a');

    // Проходим по всем пунктам меню
    navItems.forEach(function (item) {
        // Проверяем, совпадает ли путь пункта меню с текущим путем
        if (item.getAttribute('href') === currentPath) {
            // Если да, меняем классы на соответствующие цвета
            item.classList.remove('text-secondary', 'text-white');
            item.classList.add('text-secondary');
        } else {
            // Для всех остальных пунктов меню устанавливаем класс 'text-white'
            item.classList.remove('text-secondary', 'text-white');
            item.classList.add('text-white');
        }
    });
});