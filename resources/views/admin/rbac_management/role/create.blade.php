@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Создание роли @endslot
        @slot('parent') Главная @endslot
        @slot('active') Роль @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('admin.rbac_management.role.store') }}" method="post">
        @csrf
    
        {{-- Form include --}}
        @include('admin.rbac_management.role.partials.form')

    </form>
</div>

@endsection