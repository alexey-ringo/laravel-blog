@extends('admin.layouts.app_admin')
@section('content')

@component('admin.components.breadcrumbs')
        @slot('title') Список статей @endslot
        @slot('parent') Главная @endslot
        @slot('active') Статьи @endslot
@endcomponent

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                        <a href="{{route('admin.article.create')}}" class="btn btn-outline-primary" type="button">Создать статью</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Публикация</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($articles as $article)    
                                <tr>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->published}}</td>
                                    <td>
                                        
                                        <div class="table-data-feature text-right">
                                
                                            <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('admin.article.destroy', $article)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{csrf_field()}}
                                                
                                                <a href="{{ Route('admin.article.edit', $article) }}" class="btn btn-outline-success">
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
                            {{$articles->links()}}
                        </ul>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection