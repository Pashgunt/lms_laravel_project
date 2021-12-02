<table class="table table-striped table-modify">
    <tr>
        <th>Студент</th>
        <th class="center">Количество назначений</th>
        <th class="center">Действие</th>
    </tr>
    @php($current = '')
    @foreach($appointments as $appointment)
        @if ($current !== $appointment->student->username)
            @php($current = $appointment->student->username)
            <tr>
                <td>{{$appointment->student->username ?? '<без имени>'}}</td>
                <td class="center">{{$appointment->student->appointments->count() ?? ''}}</td>
                <td class="center">
                    <a class="btn btn-primary mb-3" href="/target/students/{{$appointment->student->id}}">
                        Просмотреть список курсов</a>
                </td>
            </tr>
        @endif
    @endforeach
</table>
