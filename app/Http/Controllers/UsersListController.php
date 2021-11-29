<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\EditUserRequest;
use App\LMS\Repositories\UserRepository;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Класс контроллер для работы с пользователями
 */
class UsersListController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Перенаправление на нумерованную страницу
     */
    public function redirect (): View
    {
        return $this->main('1');
    }

    /**
     * Отображение страницы со списком пользователей
     */
    public function main(string $page): View
    {
        if(!isset($page)){
            $page = 1;
        }

        try {
            $page = $page * 1;
        } catch (\Exception $e) {
            $page = 1;
        }

        if(!is_int($page)) {
            $page = 1;
        }

        /** Кол-во выводимых пользователей на страницу */
        $count = 4;

        $maxPage = ceil(count($this->repository->all()) / 4);

        if ($page > $maxPage) {
            $page = $maxPage;
        }

        $usersList = $this->repository->getUsersList($count, $page);

        $pages = $this->repository->generatePagesNumber($page, $count);

        return view('usersList', [
            'usersList' => $usersList,
            'pages' => $pages,
            'breadcrumbs' => ['' => 'Список пользователей'],
        ]);
    }

    /**
     * Отображение страницы с формой редактирования информации о пользователе
     */
    public function editPage(User $user): View
    {
        $breadcrumbs = array_merge($user->breadcrumbs, ['' => 'Редактирование пользователя ' . $user->username]);

        return view('forms/editUserInfo', [
            'user' => $user,
            'roles' => (new Role())->all(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Обработка POST на редактирование информации о пользователе
     */
    public function editInfo(EditUserRequest $request, User $user): View
    {
        $request->validated();

        $this->repository->editUserInfo($request, $user);

        return $this->editPage($this->repository->getById($user->id));
    }

    /**
     * Удаление пользователя
     */
    public function delete(Request $request, int $page): View
    {
        $userId = $request->input('userId');
        $this->repository->delete($userId);

        return $this->main($page);
    }
}
