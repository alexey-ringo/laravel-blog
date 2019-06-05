@foreach ($permissions as $permission)

  <option value="{{$permission->id ?? ""}}"
    {{--Этот блок только для редактирования роли - условие уже существования id role --}}
    @isset($role->id)
        {{--Если роль уже существует,т.е. - редактирование - перебрать весь список permission, связанных с данной ролью--}}
        @foreach($user->roles as $user_role)
            {{--Если категория из общего списка категорий уже привязана к данной новости (т.е. совпадает с приаттаченной категорией), то она должна быть выделена--}}
            @if($role->id == $user_role->id)
              selected="selected"
            @endif
        @endforeach
    
    @endisset
    >
    
    {{ $role->name ?? ""  }}
   
  </option>

 
@endforeach