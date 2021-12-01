let form = document.querySelector('.activity_add_form');
let button = document.querySelector('.accept_form');
let text_activity = document.querySelector('.text_activity');
let test_activity = document.querySelector('.test_activity');
let video_activity = document.querySelector('.video_activity');
let image_activity = document.querySelector('.image_activity');

button.addEventListener('click', function () {
    text_activity.style.display = 'none';
    test_activity.style.display = 'none';
    video_activity.style.display = 'none';
    image_activity.style.display = 'none';

    if (form.value == 1) {
        text_activity.style.display = 'block';
    }
    if (form.value == 2) {
        test_activity.style.display = 'block';
    }
    if (form.value == 3) {
        video_activity.style.display = 'block';
    }
    if (form.value == 4) {
        image_activity.style.display = 'block';
    }
    console.log(form.value);
})
