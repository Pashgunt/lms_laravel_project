<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest\SearchCourseRequest;
use App\Http\Requests\ValidateRequest\SearchUserRequest;
use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Контроллер для назначения курсов
 */
class TargetInterfaceController extends Controller
{
    protected UserRepository $userRepository;
    protected CourseRepository $courseRepository;

    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * Вывод всех допустимых пользователей и курсов
     */
    public function allInfo(string $page_course, string $page_user): View
    {
        try {
            $page_course = $page_course * 1;
            $page_user = $page_user * 1;
        } catch (\Exception $e) {
            $page_course = 1;
            $page_user = 1;
        }

        if (!is_int($page_course)) {
            $page_course = 1;
        }

        if (!is_int($page_user)) {
            $page_user = 1;
        }

        /** Кол-во выводимых пользователей на страницу */
        $count = 8;

        $maxPage = ceil(count($this->courseRepository->all()) / $count);
        $maxPageForUser = ceil(count($this->userRepository->all()) / $count);

        if ($page_course > $maxPage) {
            $page_course = $maxPage;
        }

        if ($page_user > $maxPageForUser) {
            $page_user = $maxPageForUser;
        }

        $coursesList = $this->courseRepository->getCourseList($page_course, $count);
        $usersList = $this->userRepository->getUserListWithConditional($page_user, $count, 1);

        $pages = $this->courseRepository->generatePageNumbersForUsers($page_course, $count);
        $pagesForUser = $this->userRepository->generatePagesNumber($page_user, $count);

        return view('interfaceForTarget', [
            'courses' => $coursesList,
            'users' => $usersList,
            'pages' => $pages,
            'pagesForUser' => $pagesForUser
        ]);
    }

    /**
     * Метод для поиска по пользователям
     */
    public function searchUser(SearchUserRequest $request): View
    {
        $request->validated();

        $value = $request->input('search_user_field');
        return view('interfaceForTarget', [
            'users' => $this->userRepository->searchUser($value, 1),
            'courses' => $this->courseRepository->all(),
            'search_user' => $value,
        ]);
    }

    /**
     * Метод для поиска по курсам
     */
    public function searchCourses(SearchCourseRequest $request): View
    {
        $request->validated();

        $value = $request->input('search_course_field');
        return view('interfaceForTarget', [
            'users' => $this->userRepository->all(),
            'courses' => $this->courseRepository->searchCourse($value),
            'search_course' => $value,
        ]);
    }
}
