@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование разрешенной операции @endslot
        @slot('parent') Главная @endslot
        @slot('active') Разрешенные операции @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('admin.rbac_management.permission.update', $permission) }}" method="post">
        @method('PUT')
        @csrf
    

        {{-- Form include --}}
        @include('admin.rbac_management.permission.partials.form')

    </form>
</div>

@endsection