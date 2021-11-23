<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\EditUserRequest;
use App\LMS\Repositories\UserRepository;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersListController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->repository = $userRepository;
    }

    /** Отображение страницы со списком пользователей */
    public function main($page): View
    {
        if(!is_int($page)) {
            $page = 1;
        }
        /** Кол-во выводимых пользователей на страницу */
        $count = 4;

        $maxPage = ceil(count($this->repository->all()) / 4);

        if ($page > $maxPage) {
            $page = $maxPage;
        }

        $usersList = $this->repository->getUsersList($page, $count);

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
        $userInfo = $this->repository->getUserInfo($userId);

        if (count($userInfo) === 0) {
            return view('errors/userNotFound');
        }

        return view('forms/editUserInfo', [
            'userId' => $userId,
            'userInfo' => $userInfo,
            'roles' => (new Role())->all()
        ]);
    }

    /** Обработка POST на редактирование информации о пользователе */
    public function editInfo(EditUserRequest $request, int $userId): View
    {
        $this->validateController->checkEditUser($request);
        $this->repository->editUserInfo($request, $userId);

        return view('forms/editUserInfo', [
            'userId' => $userId,
            'userInfo' => $this->repository->getUserInfo($userId),
            'roles' => (new Role())->all()
        ]);
    }

    /** Удаление пользователя */
    public function delete(Request $request, int $page): View
    {
        $userId = $request->input('userId');
        $this->repository->deleteUser($userId);

        return $this->main($page);
    }
}
