@foreach ($roles as $role)

  <option value="{{$role->id ?? ""}}"
    {{--Этот блок только для редактирования пользователя - условие существования id user --}}
    @isset($user->id)
        {{--Если пользователь существует,т.е. - это его редактирвоание - перебрать весь список ролей, связанных с данным пользователем--}}
        @foreach($user->roles as $user_role)
            {{--Если роль из общего списка ролей уже привязана к данному пользователю (т.е. совпадает с приаттаченной ролью), то она должна быть выделена--}}
            @if($role->id == $user_role->id)
              selected="selected"
            @endif
        @endforeach
    
    @endisset
    >
    
    {{ $role->name ?? ""  }}
   
  </option>

 
@endforeach