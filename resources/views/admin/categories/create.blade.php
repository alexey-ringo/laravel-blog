@extends('admin.layouts.app_admin')
@section('content')

@component('admin.components.breadcrumbs')
        @slot('title') Создание категорий @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
@endcomponent

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                
                <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{csrf_field()}}
                    {{--Form include --}}
                    @include('admin.categories.partials.form')
                </form>
                
                
            </div>    
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection