@extends('admin.layouts.app_admin')
@section('content')

@component('admin.components.breadcrumbs')
        @slot('title') Создание новости @endslot
        @slot('parent') Главная @endslot
        @slot('active') Новости @endslot
@endcomponent

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                
                <form action="{{route('admin.article.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{csrf_field()}}
                    {{--Form include --}}
                    @include('admin.articles.partials.form')
                    
                    <input type="hidden" name="created_by" value="{{Auth::id()}}">
                </form>
                
                
            </div>    
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection