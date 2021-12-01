$(() => {
    function dragItem() {
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
                    if (item.parentElement.classList.contains('search_items_user_wrapper')) {
                        $('.search_items_user').hide();
                    }
                    if (item.parentElement.classList.contains('search_items_course_wrapper')) {
                        $('.search_items_course').hide();
                    }
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
    }

    dragItem();

    function searchCourse() {
        $('.close_search_courses').on('click', () => {
            $('.search_items_course').hide();
        })
        $('.search_items_course').hide();
        $('.search_course_field').on('keyup', function () {
            $('.course_error_message').html('');
            let value = $(this).val();
            if (/^[а-яА-ЯёЁa-zA-Z0-9]+$/.test(value) === false) {
                $('.course_error_message').html("Допустимые символы для поиска только Латиница, крилица, пробелы и цифры");
                return;
            }
            $('.search_items_course').show()
            $('.search_items_course_wrapper').html('')
            let url = new URL(window.location.href);
            $.ajax({
                url: 'target-interface/search-courses',
                method: 'GET',
                data: {'search': value},
                success: function (response) {
                    let array = JSON.parse(response);
                    array.forEach(item => {
                        $('.search_items_course_wrapper').append(`<div class="btn btn-primary btn-sm mb-1 ms-1 course__draggable"
                         draggable="true" data-id="${item['id']}">${item['name']}</div>`)
                    })
                    dragItem();
                }
            })
            $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
        })
    }

    searchCourse();

    function searchUser() {
        $('.close_search_users').on('click', () => {
            $('.search_items_user').hide();
        })
        $('.search_items_user').hide();
        $('.search_user_field').on('keyup', function () {
            $('.users_error_message').html('');
            let value = $(this).val();
            if (/^[а-яА-ЯёЁa-zA-Z0-9]+$/.test(value) === false) {
                $('.users_error_message').html("Допустимые символы для поиска только Латиница, крилица, пробелы и цифры");
                return;
            }
            $('.search_items_user').show()
            $('.search_items_user_wrapper').html('')
            let url = new URL(window.location.href);
            $.ajax({
                url: 'target-interface/search-users',
                method: 'GET',
                headers: {'csrftoken': '{{ csrf_token() }}'},
                data: {'search': value},
                success: function (response) {
                    console.log(response)
                    let array = JSON.parse(response);
                    array.forEach(item => {
                        $('.search_items_user_wrapper').append(`<div class="btn btn-primary btn-sm mb-1 ms-1 user__draggable"
                         draggable="true" data-id = "${item['id']}">${item['name']}</div>`)
                    })
                    dragItem()
                }
            })
        })
    }

    searchUser()
})

