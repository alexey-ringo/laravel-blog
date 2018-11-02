@foreach ($menu_categories as $menu_category)

    @if ($menu_category->childrenCat->where('published')->count())
    {{--Если у категории есть вложенные и опубликованные пункты, тогда отрисовать вот так:--}}
    <li class="dropdown">
      <a href="{{url("/blog/category/$menu_category->slug")}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{$menu_category->title}} <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        {{--обратно в основной шаблон передаем только вложенные категории, а не родителей--}}
        @include('layouts.top_menu', ['menu_categories' => $menu_category->childrenCat])
      </ul>
    @else
    <li>
      <a href="{{url("/blog/category/$menu_category->slug")}}">{{$menu_category->title}}</a>
    @endif
    </li>

@endforeach