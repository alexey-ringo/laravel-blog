<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gate;

class ArticleController extends Controller
{
    //public function __construct() {
        //parent::__construct();
        
    //    if(Gate::denies('VIEW_ARTICLE')) {
    //        abort(403);
    //    }
        
    //}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //передаем переменную с новостями
        //сортировка по новостям в обратном порядке по дате создания новости
        return view('admin.articles.index', [
            'articles' => Article::orderBy('created_at', 'desc')->paginate(7)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //if(Gate::denies('add-article')) {
        //    return redirect()->back()->with(['message' => 'У Вас недостаточно прав на реактирование этого материала']);
        //}
        if(Gate::denies('create', Article::class)) {
            return redirect()->back()->with(['message' => 'У Вас недостаточно прав на реактирование этого материала']);
        }
        
        return view('admin.articles.create', [
            'article' => [],
            
            //categories - дерево коллекций категорий для присвоения их новости
            //with('childrenCat') - коллекции категорий с вложенными категориями
            //where('parent_id', 0) - получаем категории, которые являются только родителями и никому не подчиняются
            'categories' => Category::with('childrenCat')->where('parent_id', 0)->get(),
            
            //Некий символ, определяющий вложенность категорий. Для наглядности визуализации
            'delimiter' => ''
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Создаем модель Новости и заполняем всеми полями из POST
        //$article = Article::create($request->all());
        $user = User::find($request->user()->id);
        
        //$validator = $request->validate([
        //    'title' => 'required|string|max:255',
        //    'slug' => 'required|string|max:255',
        //]);
        
        /*
        $article = new Article([
            'slug' => $request['slug'],
            'description' => $request['description'],
            
        ]);
        $user->articles()->save($article);
        */
        
        $article = $user->articles()->create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'description_short' => $request['description_short'],
            'description' => $request['description'],
            //'image' => $request['description'],
            //'image_show' => $request['description'],
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'meta_keyword' => $request['meta_keyword'],
            'published' => $request['published'],
            'user_id' => $user->id,
        ]);
            /*    
            $table->string('slug')->unique();
            $table->text('description_short')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            $table->boolean('image_show')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->boolean('published');
            $table->integer('viewed')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            */
        
        //Проверка на наличие полученного от формы значения поля с name="categories"
        if($request->input('categories')) :
            //Присоединяем массив с выбранными для данной статьи категориями
            //Передаем в attach() массив категорий для присоединения
            $article->categoriesToArticles()->attach($request->input('categories'));
        endif;
        
        return redirect()->route('admin.article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
        //Редактируемая новость
          'article'    => $article,
          //Список приаттаченных к редактируемой новости категорий
          'categories' => Category::with('childrenCat')->where('parent_id', 0)->get(),
          //Символ вложенности
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->except('slug'));
        //Если список категорий пуст - отсоединяем
        $article->categoriesToArticles()->detach();
        if($request->input('categories')) :
          $article->categoriesToArticles()->attach($request->input('categories'));
        endif;
        
        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //Отсоединяем все связи с категориями
        $article->categoriesToArticles()->detach();
        //Удаляем экземпляр новости
        $article->delete();
        
        return redirect()->route('admin.article.index');
    }
}
