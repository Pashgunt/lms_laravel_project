<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\AppointmentRepository;
use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

    public function __construct(UserRepository        $userRepository,
                                CourseRepository      $courseRepository,
                                AppointmentRepository $repository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        $this->repository = $repository;
    }

    /**
     * Вывод всех допустимых пользователей и курсов
     */
    public function allInfo(): View
    {
        $coursesList = $this->courseRepository->getCourseList(config('pagination.course'));
        $usersList = $this->userRepository->getSpecialUserListController(config('pagination.user'));

        $page_for_course = $_GET['page_course'] ?? 1;
        $page_for_user = $_GET['page_user'] ?? 1;

        if ($coursesList->lastPage() < $coursesList->currentPage()) {
            return view('errors.404');
        }

        if ($usersList->lastPage() < $usersList->currentPage()) {
            return view('errors.404');
        }

        return view('interfaceForTarget', [
            'coursesList' => $coursesList,
            'usersList' => $usersList,
            'pages_for_users' => $page_for_user,
            'pages_for_courses' => $page_for_course,
            'url' => URL::previous()
        ]);
    }

    /**
     * Метод для поиска по пользователям
     */
    public function searchUser(Request $request)
    {
        if ($request->ajax()) {
            $output = [];
            $products = $this->userRepository->searchUser($request->search);
            if ($products) {
                foreach ($products as $key => $product) {
                    array_push($output, ['name' => $product->username, 'id' => $product->id]);
                }
            }
        }
        $output_json = json_encode($output);
        return $output_json;
    }

    /**
     * Метод для поиска по курсам
     */
    public function searchCourses(Request $request)
    {
        if ($request->ajax()) {
            $output = [];
            $products = $this->courseRepository->searchCourse($request->search);
            if ($products) {
                foreach ($products as $key => $product) {
                    array_push($output, ['name' => $product->name, 'id' => $product->id]);
                }
            }
        }
        $output_json = json_encode($output);
        return $output_json;
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
