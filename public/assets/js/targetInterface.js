$(() => {

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

    let targetAjax = (objOfTarget) => {
        $.ajax({
            url: '/target-interface',
            method: 'POST',
            data: {
                'arr': JSON.stringify(objOfTarget)
            },
            success(response) {
                location.reload();
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

        targetAjax(objOfTarget);
    })

})


