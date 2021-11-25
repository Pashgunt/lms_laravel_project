$(() => {

    let allUsersDraggable = document.querySelectorAll('.user__draggable');
    let allCoursesDraggable = document.querySelectorAll('.course__draggable');

    let allUsersDragover = document.querySelectorAll('.users__dragover');
    let allCoursesDragover = document.querySelectorAll('.courses__dragover');

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

            dragOver.forEach((item, index) => {
                item.addEventListener('dragover', e => {
                    e.preventDefault();
                })
                item.addEventListener('dragenter', function (e) {
                    e.preventDefault();
                    if (draggedItem === null) {
                        this.style.background = 'rgba(255,0,0,.2)';
                        return;
                    }
                    this.style.background = 'rgba(57,255,20,.2)';
                })
                item.addEventListener('dragleave', function (e) {
                    this.style.background = 'rgba(57,255,20, 0)';
                })
                item.addEventListener('drop', function (e) {
                    if (draggedItem === null) {
                        this.style.background = 'rgba(57,255,20, 0)';
                        return;
                    }
                    this.style.background = 'rgba(57,255,20, 0)';
                    this.append(draggedItem);
                })
            })
        })
    }

    drag(allUsersDraggable, allUsersDragover);
    drag(allCoursesDraggable, allCoursesDragover);

    let targetAjax = () => {
        $.ajax({
            url: '/target/courses',
            method: 'POST',
            data: {},
            success(response) {
                location.reload();
                return response;
            },
            error(response) {
                alert(response);
            }
        })
    }

    targetAjax();
})


