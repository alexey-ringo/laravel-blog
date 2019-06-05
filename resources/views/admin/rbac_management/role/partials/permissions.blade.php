@foreach ($permissions as $permission)

  <option value="{{$permission->id ?? ""}}"
    {{--Этот блок только для редактирования роли - условие уже существования id role --}}
    @isset($role->id)
        {{--Если роль уже существует,т.е. - ее редактирование - перебрать весь список permission, связанных с данной ролью--}}
        @foreach($role->permissions as $role_permission)
            {{--Если permission из общего списка permissions уже привязан к данной role (т.е. совпадает с приаттаченной role), то она должна быть выделена--}}
            @if($permission->id == $role_permission->id)
              selected="selected"
            @endif
        @endforeach
    
    @endisset
    >
    
    {{ $permission->name ?? ""  }}
   
  </option>

 
@endforeach