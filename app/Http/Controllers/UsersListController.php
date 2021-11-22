<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class UsersListController extends Controller
{
    protected User $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User;
    }


    /** Отображение страницы со списком пользователей */
    public function main(int $page): object
    {
        /** Кол-во выводимых пользователей на страницу */
        $count = 4;

        $usersList = $this->model->getUsersList($page, $count);

        $maxPage = ceil(count($this->model->all()) / 4);

        $pages = [
            'main_page' => $page
        ];

        if ($page > 1) {
            $pages['min_page'] = 1;
        }

        if ($maxPage > 1 && $maxPage != $page) {
            $pages['max_page'] = $maxPage;
        }

        if ($page - 1 > 1) {
            $pages['prev_page'] = $page - 1;
        }

        if ($page + 1 < $maxPage) {
            $pages['next_page'] = $page + 1;
        }

        return view('usersList', [
            'usersList' => $usersList,
            'pages' => $pages
        ]);
    }

    /** Отображение страницы с формой редактирования информации о пользователе */
    public function editPage(int $userId): object
    {
        return view('forms/editUserInfo', [
            'userId' => $userId,
            'userInfo' => $this->model->getUserInfo($userId),
            'roles' => (new Roles())->all()
            ]);
    }

    /** Обработка POST на редактирование информации о пользователе */
    public function editInfo(int $userId): object
    {
        $message = 'Редактирование успешно';

        if(!$this->model->editUserInfo($userId)) {
            $message = 'Ошибка редактирования!';
        }

        return $this->editPage($userId);
    }

    public function delete(int $page): object
    {
        $userId = $_POST['userId'];
        $this->model->deleteUser($userId);

        return $this->main($page);
    }
}
