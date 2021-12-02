<?php

namespace App\Http\Controllers;

use App\LMS\Repositories\AppointmentRepository;
use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use App\Models\Appointment;
use App\Models\Course;
use App\Models\User;
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

    public function __construct(
        UserRepository $userRepository,
        CourseRepository $courseRepository,
        AppointmentRepository $repository
    ) {
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
    public function searchUser(Request $request): string
    {
        $output = [];
        if ($request->ajax()) {
            $products = $this->userRepository->searchUser($request->search);
            if ($products) {
                foreach ($products as $key => $product) {
                    array_push($output, ['name' => $product->username, 'id' => $product->id]);
                }
            }
        }

        return json_encode($output);
    }

    /**
     * Метод для поиска по курсам
     */
    public function searchCourses(Request $request): string
    {
        $output = [];
        if ($request->ajax()) {
            $products = $this->courseRepository->searchCourse($request->search);
            if ($products) {
                foreach ($products as $key => $product) {
                    array_push($output, ['name' => $product->name, 'id' => $product->id]);
                }
            }
        }

        return json_encode($output);
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
    public function show(Request $request, string $subject = 'course'): View
    {
        $searchParam = $request->input('search_' . $subject . '_field');
        $searchResult = [];
        $appointments = [];

        if ($searchParam) {
            $repository = $subject . 'Repository';
            $method = 'search' . ucfirst($subject);
            $searchResult = $this->$repository->$method($searchParam);
        } else {
            $appointments = $this->repository->orderByRaw($subject . '_id')
                ->paginate(config('pagination.appointment'));

            if ($appointments->lastPage() < $appointments->currentPage()) {
                return view('errors.404');
            }
        }

        return view('appointments.appointmentsList', [
            'appointments' => $appointments,
            'subject' => $subject,
            'searchResult' => $searchResult,
            'searchParam' => $searchParam,
            'url' => URL::previous()
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
     */
    public function students(Request $request): View
    {
        return $this->show($request, 'user');
    }

    /**
     * Вывод детальной информации по субъету (курс\студент)
     */
    public function showAppointmentsBySubject(Course $course = null, User $user = null): View
    {
        return view('appointments.appointmentsBySubject', [
            'user' => $user,
            'course' => $course,
            'url' => URL::previous()
        ]);
    }
}
