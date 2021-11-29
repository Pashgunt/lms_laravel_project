$(() => {
    $('.success_target').hide();

    let allUsersDraggable = document.querySelectorAll('.user__draggable');
    let allCoursesDraggable = document.querySelectorAll('.course__draggable');

    let allUsersDragover = document.querySelector('.users__dragover');
    let allCoursesDragover = document.querySelector('.courses__dragover');

    let buttonTarget = document.querySelector('.button_target');

    function drag(dragItem, dragOver) {
        let draggedItem = null;

        dragItem.forEach(item => {
            item.addEventListener('dragstart', () => {
                draggedItem = item;
                setTimeout(() => {
                    item.style.display = 'none';
                }, 0)
            })

            item.addEventListener('dragend', () => {
                setTimeout(() => {
                    item.style.display = 'block';
                    draggedItem = null;
                }, 0)
            })

            item.addEventListener('dblclick', () => {
                let parentElement = item.parentElement;

                if (parentElement.classList.contains('users__dragover')) {
                    $('.target_user_append').append(item);
                    return;
                }

                $('.target_course_append').append(item)
            })

            dragOver.addEventListener('dragover', e => {
                e.preventDefault();
            })
            dragOver.addEventListener('dragenter', function (e) {
                e.preventDefault();
                if (draggedItem === null) {
                    this.style.background = 'rgba(255,0,0,.2)';
                    return;
                }
                this.style.background = 'rgba(57,255,20,.2)';
            })
            dragOver.addEventListener('dragleave', function (e) {
                this.style.background = 'rgba(57,255,20, 0)';
            })
            dragOver.addEventListener('drop', function (e) {
                if (draggedItem === null) {
                    this.style.background = 'rgba(57,255,20, 0)';
                    return;
                }
                this.style.background = 'rgba(57,255,20, 0)';
                this.append(draggedItem);
            })
        })
    }

    let targetAjax = (objOfTarget, firstArg, secondArg) => {
        $.ajax({
            url: `/target-interface/${firstArg}/${secondArg}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'arr': JSON.stringify(objOfTarget)
            },
            success(response) {
                $('.success_target').show();
                $('.success_target').html('Успешно назначены курсы');
                return response;
            }
        })
    }

    drag(allUsersDraggable, allUsersDragover);
    drag(allCoursesDraggable, allCoursesDragover);

    buttonTarget.addEventListener('click', () => {

        let arrOfUsers = [];

        allUsersDragover.querySelectorAll('.user__draggable').forEach(item => {
            arrOfUsers.push(+item.getAttribute("data-id"));
        })

        let arrOfCourses = [];

        allCoursesDragover.querySelectorAll('.course__draggable').forEach(item => {
            arrOfCourses.push(+item.getAttribute("data-id"));
        });

        let objOfTarget = {
            'users': arrOfUsers,
            'courses': arrOfCourses,
        }

        let url = new URL(window.location.href);

        let arr = url.pathname.split('/');

        let firstArg = null;
        let secondArg = null;

        arr.forEach((item, index) => {
            if (!isNaN(parseInt(item))) {
                if (index % 2 === 0) {
                    firstArg = item;
                } else {
                    secondArg = item;
                }
            }
        })

        let objectValues = Object.values(objOfTarget);

        for (let i = 0; i < objectValues.length; i++) {
            if (objectValues[i].length === 0) {
                $('.success_target').show();
                $('.success_target').html('Список назначений пуст');
                return;
            }
        }

        targetAjax(objOfTarget, firstArg, secondArg);
    })
})


