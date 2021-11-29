let button = document.querySelectorAll('.confirm_delete');

for (let i = 0; i < button.length; i++) {
    button[i].addEventListener('click', function () {
        let result = confirm('Подтвердите удаление');

        if (result === false) {
            const evt = window.event;
            evt.preventDefault();
        }
    })
}
