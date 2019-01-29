@foreach ($menu_categories as $menu_category)

    @if ($menu_category->childrenCat->where('published', 1)->count())
    {{--Если у категории есть вложенный и опубликованный пункт, тогда отрисовать вот так:--}}
        <li class="nav-item dropdown">
            <a href="{{ route('category', $menu_category->slug) }}" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{ $menu_category->title }}
            </a>
            <div class="dropdown-menu">
                @include('layouts.menu', [
                    'menu_categories' => $menu_category->childrenCat,
                    'isChild' => true
                ])
            </div>
        </li>
    @else
    {{--Если у категории нет вложенного и опубликованного пункта - проверка, загружены ли сейчас в шаблон вложенные пункты?--}}
        @isset ($isChild)
            {{--Если да - отображаем ссылки для вложенных--}}
            <a class="nav-link" href="{{ route('category', $menu_category->slug) }}">{{ $menu_category->title ?? '' }}</a>
            {{--Покидаем текущий цикл - следующие вложенные каты будут загружены при следующем проходе--}}
            @continue
        @endif
        {{--Разметка для пунктов без вложенных пунктов--}}
        <li class="nav-item">             
            <a class="nav-link" href="{{ route('category', $menu_category->slug) }}">{{ $menu_category->title ?? '' }}</a>
        </li>
    @endif
    
    
@endforeach