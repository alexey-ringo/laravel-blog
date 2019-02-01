@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование пользователя @endslot
        @slot('parent') Главная @endslot
        @slot('active') Пользователи @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('admin.user_management.user.update', $user) }}" method="post">
        @method('PUT')
        @csrf
    

        {{-- Form include --}}
        @include('admin.user_management.user.partials.form')

    </form>
</div>

@endsection