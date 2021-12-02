<table class="table table-striped table-modify">
    <tr>
        <th>Название курса</th>
        <th>Автор</th>
        <th class="center">Количество назначений</th>
        <th>Дата создания</th>
        <th class="center">Действие</th>
    </tr>

    @php($current = '')
    @foreach($appointments as $appointment)
        @if ($current !== $appointment->course->name)
            @php($current = $appointment->course->name)
            <tr>
                <td>{{$appointment->course->name ?? ''}}</td>
                <td>{{$appointment->course->author->username ?? ''}}</td>
                <td class="center">{{$appointment->course->appointments->count() ?? ''}}</td>
                <td>{{$appointment->course->created_at}}</td>
                <td class="center">
                    <a class="btn btn-primary mb-3" href="/target/courses/{{$appointment->course->id}}">
                        Просмотреть список студентов</a>
                </td>
            </tr>
        @endif
    @endforeach
</table>
