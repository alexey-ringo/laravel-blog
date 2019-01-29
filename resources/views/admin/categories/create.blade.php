@extends('admin.layouts.app_admin')
@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Создание категорий @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
    
    <hr />

    <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        {{--Form include --}}
        @include('admin.categories.partials.form')
    </form>
</div>

@endsection