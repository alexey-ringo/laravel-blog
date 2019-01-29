@extends('admin.layouts.app_admin')
@section('content')

<div class="container">

    @component('admin.components.breadcrumbs')
        @slot('title') Редиктирование категорий @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
    
    <hr />

    <form class="form-horizontal" action="{{route('admin.category.update', $category)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        {{--Form include --}}
        @include('admin.categories.partials.form')
    </form>

</div>
@endsection