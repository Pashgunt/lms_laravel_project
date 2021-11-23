<?php

namespace App\Http\Controllers;

use App\Http\Request\ValidateController;
use App\Http\Request\ValidateRequest\RegRequest;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersListController
{
    protected User $model;

    public function __construct()
    {
        $this->model = new User;
    }

    /** Отображение страницы со списком пользователей */
    public function main(int $page): View
    {
        /** Кол-во выводимых пользователей на страницу */
        $count = 4;

        $maxPage = ceil(count($this->model->all()) / 4);

        if($page > $maxPage) {
            $page = $maxPage;
        }

        $usersList = $this->model->getUsersList($page, $count);

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
    public function editPage(int $userId): View
    {
        return view('forms/editUserInfo', [
            'userId' => $userId,
            'userInfo' => $this->model->getUserInfo($userId),
            'roles' => (new Roles())->all()
            ]);
    }

    /** Обработка POST на редактирование информации о пользователе */
    public function editInfo(RegRequest $request, int $userId): View
    {
        $validate = new ValidateController();
        $validate->checkReg($request);
        $this->model->editUserInfo($request, $userId);

        return $this->editPage($userId);
    }

    public function delete(Request $request, int $page): object
    {
        $userId = $request->input('userId');
        $this->model->deleteUser($userId);

        return $this->main($page);
    }
}
