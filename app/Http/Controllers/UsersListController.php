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
    public function redirect(): View
    {
        return $this->main('1');
    }

    /**
     * Отображение страницы со списком пользователей
     */
    public function main(): View
    {
        $usersList = $this->repository->getUsersList(config('pagination.user'));
        $page = $_GET['page'] ?? 1;

        if ($usersList->lastPage() < $usersList->currentPage()) {
            return view('errors.404');
        }

        return view('usersList', [
            'usersList' => $usersList,
            'page' => $page,
        ]);
    }

    /**
     * Отображение страницы с формой редактирования информации о пользователе
     */
    public function editPage(User $user): View
    {
        return view('forms/editUserInfo', [
            'user' => $user,
            'roles' => (new Role())->all()
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
    public function delete(Request $request): View
    {
        $userId = $request->input('userId');
        $this->repository->delete($userId);

        return $this->main();
    }
}
