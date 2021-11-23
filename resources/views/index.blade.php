
@extends('layout')

@section('style')
    <link rel="stylesheet" href="assets/css/reg.css">
@endsection

@section ('content')
    <?= \Illuminate\Support\Facades\Auth::user();
    $user = \Illuminate\Support\Facades\Auth::user()?>
        <?php $role = App\Models\Role::find($user->role_id);
            //\Illuminate\Support\Facades\Auth::user()->role_id);
        echo $role->role_name;?>
@endsection

