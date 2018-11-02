@foreach ($categories as $category)

  <option value="{{$category->id ?? ""}}"
    {{--Этот блок только для редактирования новостей - условие существования id новости/поста--}}
    @isset($article->id)
        {{--Если статья существует,т.е. - редактирвоание - перебор общего списка категорий--}}
        @foreach($article->findCatForArticles as $category_article)
            {{--Если категория из общего списка привязана к данной новости, то она должна быть выведена--}}
            @if($category->id == $category_article->id)
              selected="selected"
            @endif
        @endforeach
    
    @endisset
    >
    {!! $delimiter or "" !!}{{$category->title ?? ""}}
  </option>

  @if(count($category->childrenCat) > 0)
    {{--Если у категории есть хоть одна вложенная категория - снова подключаем этот же самый шаблон--}}
    @include('admin.articles.partials.categories', [
      {{--Во вновь подключенный рекурсионным образом шаблон передаем только категории, 
      которые является вложенными для данной категории--}}
      'categories' => $category->childrenCat,
      {{--при каждой итерации добавляем в delimiter новый дефис для визуального отличия от вышестоящих--}}
      'delimiter'  => ' - ' . $delimiter
    ])
    
  @endif
@endforeach