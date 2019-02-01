@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Создание пользователя @endslot
        @slot('parent') Главная @endslot
        @slot('active') Пользователь @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('admin.user_management.user.store') }}" method="post">
        @csrf
    
        {{-- Form include --}}
        @include('admin.user_management.user.partials.form')

    </form>
</div>

@endsection