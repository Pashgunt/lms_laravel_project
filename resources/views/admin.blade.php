<div class="admin_content mt-3">
    @if (mb_strtolower(Auth::user()->role->role_name) === \App\Models\Role::ROLE_ADMIN)
    <a href="/users/list" class="btn btn-primary" role="button">Управление пользователями</a>
    @endif
    <a href="/courses" class="btn btn-primary" role="button">Управление курсами</a>
    <a href="/target" class="btn btn-primary" role="button">Управление назначениями</a>
</div>


