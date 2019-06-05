@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование роли @endslot
        @slot('parent') Главная @endslot
        @slot('active') Роли @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('admin.rbac_management.role.update', $role) }}" method="post">
        @method('PUT')
        @csrf
    

        {{-- Form include --}}
        @include('admin.rbac_management.role.partials.form')

    </form>
</div>

@endsection