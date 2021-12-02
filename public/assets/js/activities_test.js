let add_q_button = document.querySelector('.add_question');
let main_block = document.querySelector('.questions_list');
let questions_block = document.querySelector('.added_question');
let count_questions = document.querySelector('.count_questions');

add_q_button.addEventListener('click', function () {
    main_block.style.display = 'block';
    questions_block.innerHTML = '';
    let count = count_questions.value;
    console.log(count);
    for(let i = 1; i <= count; i++) {
        let form = `<div class="question">`
            + `<label>Вопрос ${i}<br><input type="text" name="question${i}" placeholder="Текст вопроса"></label><br>`
            + `<input type="text" name="answer1-${i}" placeholder="Ответ 1"><br>`
            + `<input type="text" name="answer2-${i}" placeholder="Ответ 2"><br>`
            + `<input type="text" name="answer3-${i}" placeholder="Ответ 3"><br>`
            + `<input type="text" name="answer4-${i}" placeholder="Ответ 4"><br>`
            + `<label>Правильный ответ<input type="number" name='trueAnswer${i}' min="1" max="4" value="1"></label>`
            + `</div><br>`;
        $('.added_question').append(form);
    }
})
