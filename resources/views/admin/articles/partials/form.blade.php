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
                        {{--Если существует переданный id новости - значит это edit --}}
                    @if(isset($article->id))
                        <option value="0" @if($article->published == 0) selected="" @endif>
                            Не опубликовано
                        </option>
                        <option value="1" @if($article->published == 1) selected="" @endif>
                            Опубликовано
                        </option>
                    @else
                        {{--Если не существует переданный id новости - значит это create --}}
                        <option value="0" selected="">Не опубликовано</option>
                        <option value="1" selected="">Опубликовано</option>
                    @endif
                    </select>
                </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="title" class=" form-control-label">Заголовок</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" id="title" name="title" placeholder="Заголовок новости" 
                class="form-control" value="{{$article->title ?? ""}}" required>
                    <small class="form-text text-muted">This is a help text</small>
            </div>
        </div>
            
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="slug" class=" form-control-label">Slug (Уникальное значение)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" id="slug" name="slug" placeholder="Автоматическая генерация" 
                    class="form-control" value="{{$article->slug ?? ""}}" readonly="">
                <small class="form-text text-muted">This is a help text</small>
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="categories" class=" form-control-label">Родительская категория</label>
            </div>
            <div class="col-12 col-md-9">
                <select name="categories[]" id="categories" class="form-control" multiple="">
                    @include('admin.articles.partials.categories', ['categories' => $categories])
                </select>
            </div>
        </div>
        
        <div class="row form-group">
                <div class="col col-md-2">
                    <label for="description_short" class=" form-control-label">Краткое описание поста</label>
                </div>
                <div class="col-12 col-md-10">
                    <textarea name="description_short" id="description_short" rows="9" placeholder="Краткое описание..." class="form-control">{{$article->description_short ?? ""}}</textarea>
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col col-md-2">
                    <label for="description" class=" form-control-label">Полное описание поста</label>
                </div>
                <div class="col-12 col-md-10">
                    <textarea name="description" id="description" rows="9" placeholder="Полное описание..." class="form-control">{{$article->description ?? ""}}</textarea>
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col col-md-2">
                    <label for="meta_title" class=" form-control-label">Мета-заголовок</label>
                </div>
                <div class="col-12 col-md-10">
                    <input type="text" id="meta_title" name="meta_title" placeholder="Мета-заголовок" 
                    class="form-control" value="{{$article->meta_title ?? ""}}">
                        <small class="form-text text-muted">This is a help text</small>
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col col-md-2">
                    <label for="meta_description" class=" form-control-label">Мета-описание</label>
                </div>
                <div class="col-12 col-md-10">
                    <input type="text" id="meta_description" name="meta_description" placeholder="Мета-описание" 
                    class="form-control" value="{{$article->meta_description ?? ""}}">
                        <small class="form-text text-muted">This is a help text</small>
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col col-md-2">
                    <label for="meta_keyword" class=" form-control-label">Ключевые слова</label>
                </div>
                <div class="col-12 col-md-10">
                    <input type="text" id="meta_keyword" name="meta_keyword" placeholder="Ключевые слова, через запятую" 
                    class="form-control" value="{{$article->meta_keyword ?? ""}}">
                        <small class="form-text text-muted">This is a help text</small>
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