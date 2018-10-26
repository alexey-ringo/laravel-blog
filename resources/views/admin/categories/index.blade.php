@extends('admin.layouts.app_admin')
@section('content')

@component('admin.components.breadcrumbs')
        @slot('title') Список категорий @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
@endcomponent

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                        <a href="{{route('admin.category.create')}}" class="btn btn-outline-primary" type="button">Создать категорию</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Родительская</th>
                                    <th>Публикация</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)    
                                <tr>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->parent_id}}</td>
                                    <td>{{$category->published}}</td>
                                    <td>
                                        
                                        <div class="table-data-feature text-right">
                                
                                            <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('admin.category.destroy', $category)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{csrf_field()}}
                                                
                                                <a href="{{ Route('admin.category.edit', $category) }}" class="btn btn-outline-success">
                                                Редактировать
                                                </a>
                            
                              
                                                <button type="submit" class="btn btn-outline-danger">
                                                    Удалить
                                                </button>
                                            </form>
                                        </div>
                                        
                                    </td>
                                </tr>
                        
                            @empty
                        
                                <tr>
                                    <td>
                                        Данные отсутствуют
                                    </td>
                                </tr>
                        
                            @endforelse
                            </tbody>
                        </table>
                  
                    </div>
                    
                    <div class="cart-footer">
                        <ul class="pagination pull-right">
                            {{$categories->links()}}
                        </ul>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection