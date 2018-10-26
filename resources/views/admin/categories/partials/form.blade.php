<div class="card">
    <div class="card-header">
        <strong>Basic Form</strong> Elements
    </div>
    <div class="card-body card-block">
                        
        <div class="row form-group">
            <div class="col col-md-3"><label for="select" class=" form-control-label">Статус</label></div>
                <div class="col-12 col-md-9">
                    <select name="select" id="select" data-placeholder="Выберите статус категории..." class="standardSelect" tabindex="1">
                        {{--Форма универсальная для create и edit --}}
                        {{--Если существует переданный id категории - значит это edit --}}
                    @if(isset($category->id))
                        <option value="0" @if($category->published == 0) selected="" @endif>
                            Не опубликовано
                        </option>
                        <option value="1" @if($category->published == 1) selected="" @endif>
                            Опубликовано
                        </option>
                    @else
                        {{--Если не существует переданный id категории - значит это create --}}
                        <option value="0" selected="">Не опубликовано</option>
                        <option value="1" selected="">Опубликовано</option>
                    @endif
                    </select>
                </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="title" class=" form-control-label">Наименование</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" id="title" name="title" placeholder="Заголовок категории" 
                class="form-control" value="{{$category->title ?? ""}}" required>
                    <small class="form-text text-muted">This is a help text</small>
            </div>
        </div>
            
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="slug" class=" form-control-label">Slug</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" id="slug" name="slug" placeholder="Автоматическая генерация" 
                    class="form-control" value="{{$category->slug ?? ""}}" readonly="">
                <small class="form-text text-muted">This is a help text</small>
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="parent_id" class=" form-control-label">Родительская категория</label>
            </div>
            <div class="col-12 col-md-9">
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="0">-- без родительской категории --</option>
                    @include('admin.categories.partials.categories', ['categories' => $categories])
                </select>
            </div>
        </div>
                          
    </div>
    
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
        <button type="reset" class="btn btn-danger btn-sm">
          <i class="fa fa-ban"></i> Reset
        </button>
    </div>
</div>
                    
                  