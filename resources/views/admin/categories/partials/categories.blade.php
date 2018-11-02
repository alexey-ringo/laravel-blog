@foreach ($categories as $category_list)

  <option value="{{$category_list->id ?? ""}}"
    {{--Этот блок только для редактирования категорий - условия существования id категории--}}
    @isset($category->id)
    
        {{--поиск только родительских категорий--}}    
      @if ($category->parent_id == $category_list->id)
        selected=""
      @endif
        
        {{--убираем из списка род. кат. текущую редактируемую категорию--}}
      @if ($category->id == $category_list->id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter ?? "" !!}{{$category_list->title ?? ""}}
  </option>

  @if(count($category_list->childrenCat) > 0)
    {{--Если у категории есть хоть одна вложенная категория - снова подключаем этот же самый шаблон--}}
    @include('admin.categories.partials.categories', [
      {{--Во вновь подключенный рекурсионным образом шаблон передаем только категории, 
      которые является вложенными для данной категории--}}
      'categories' => $category_list->childrenCat,
      {{--при каждой итерации добавляем в delimiter новый дефис для визуального отличия от вышестоящих--}}
      'delimiter'  => ' - ' . $delimiter
    ])
    
  @endif
@endforeach