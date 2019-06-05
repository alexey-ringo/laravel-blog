@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Список ролей @endslot
        @slot('parent') Главная @endslot
        @slot('active') Роли @endslot
    @endcomponent

    <a href="{{ route('admin.rbac_management.role.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>

    <table class="table table-striped table-borderless">
        <thead class="thead-dark">
            <th>Имя</th>
            <th>Описание</th>
            <th>Разрешенные операции</th>
            <th class="text-right">Действие</th>
        </thead>
        <tbody>
        @forelse ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td></td>
                <td>
                    @foreach($role->permissions as $permissions_title) 
                        {{$permissions_title->name}} , 
                    @endforeach
                </td>
                <td class="text-right">
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('admin.rbac_management.role.destroy', $role) }}" method="post">
                        @method('DELETE')
                        @csrf
                    
                        <a class="btn btn-primary" href="{{ route('admin.rbac_management.role.edit', $role) }}"><i class="fa fa-edit"></i></a>

                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    {{ $roles->links() }}
                </td>
            </tr>
        </tfoot>
    </table>

</div>

@endsection