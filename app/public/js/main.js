const new_task = document.querySelector('.new_task');
const task_place = document.querySelector('.tasks__news');
if (new_task) {
    new_task.addEventListener('click', function () {
        task_place.innerHTML =
            '<div class="tasks__new d-flex">' +
            '  <p class="align-self-end">Новая задача</p>\n' +
            '  <div class="tasks__item align-items-center m-2">\n' +
            '    <input type="text" placeholder="Имя" name="nameNew" value="">\n' +
            '    <input type="email" placeholder="Почта" name="emailNew" value="">\n' +
            '    <input type="text" placeholder="Задача" name="taskNew" value="">\n' +
            '  </div>\n' +
            '  <button class="btn btn-dark align-self-end" type="submit" name="save" value="new">Добавить задачу</button>' +
            '</div>';
    });
}