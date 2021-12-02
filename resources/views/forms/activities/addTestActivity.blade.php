<div class="test_activity">
    <label>
        Заголовок -
        <input type="text" name="test_title" placeholder="Заголовок" style="margin-bottom: 20px">
    </label><br>
    <label>
        Описание - <br>
        <textarea name="test_about" rows="5" cols="50"></textarea>
    </label><br>
    <label>
        Количество вопросов -
        <input type="number" name='test_count' min="1" max="12" class="count_questions" value="1">
        <div class="add_question btn btn-success">Добавить</div>
        <div class="questions_list">
            <form action="" method="post">
            Вопросы:
            <div class="added_question">

            </div>
            </form>
        </div>
    </label>
</div>
