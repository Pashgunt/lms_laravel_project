<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\AppointmentRepository;
use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

/**
 * Контроллер для управления назначениями курсов
 */
class TargetInterfaceController extends Controller
{
    protected UserRepository $userRepository;
    protected CourseRepository $courseRepository;
    protected AppointmentRepository $repository;

    public function __construct(UserRepository        $userRepository, CourseRepository $courseRepository,
                                AppointmentRepository $repository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        $this->repository = $repository;
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
            'pagesForUser' => $pagesForUser,
            'url' => URL::previous()
        ]);
    }

    /**
     * Метод для поиска по пользователям
     */
    public function searchUser(Request $request, string $page_course, string $page_user): View
    {
        $value = $request->input('search_user_field');

        if ($value) {
            return view('interfaceForTarget', [
                'users' => $this->userRepository->searchUser($value, 1),
                'courses' => $this->courseRepository->all(),
                'search_user' => $value,
                'url' => URL::previous()
            ]);
        }

        return $this->allInfo('1', '1');
    }

    /**
     * Метод для поиска по курсам
     */
    public function searchCourses(Request $request): View
    {
        $value = $request->input('search_course_field');

        if ($value) {
            return view('interfaceForTarget', [
                'users' => $this->userRepository->all(),
                'courses' => $this->courseRepository->searchCourse($value),
                'search_course' => $value,
                'url' => URL::previous()
            ]);
        }

        return $this->allInfo('1', '1');
    }

    /**
     * Сохраняет назначения в базу
     */
    public function createAppointment(Request $request): void
    {
        $this->repository->updateOrCreateAppointment($request);
    }

    /**
     * Отображает перечень всех назначений
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function show(Request $request, string $filter = 'course'): View
    {
        $searchParam = $request->input('search_' . $filter . '_field');
        $searchResult = [];
        $appointments = [];

        if ($searchParam) {
            $repository = $filter . 'Repository';
            $method = 'search' . ucfirst($filter);
            $searchResult = $this->$repository->$method($searchParam);
        } else {
            $appointments = $this->repository->orderByRaw($filter . '_id')
                ->paginate(config('pagination.appointment'));

            if ($appointments->lastPage() < $appointments->currentPage()) {
                return view('errors.404');
            }
        }

        return view('appointments' . ucfirst($filter) . 'sList', [
            'appointments' => $appointments,
            'searchResult' => $searchResult,
            'searchParam' => $searchParam
        ]);
    }

    /**
     * Удаляет назначение из базы
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();

        return back();
    }

    /**
     * Отображение назначений по списку пользователей
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function students(Request $request)
    {
        return $this->show($request, 'user');
    }


}
