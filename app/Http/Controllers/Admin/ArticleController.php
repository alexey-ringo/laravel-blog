<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
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
        return view('admin.articles.create', [
            'article' => [],
            
            //categories - дерево коллекций категорий для присвоения их новости
            //with('findChildrenCat') - коллекции категорий с вложенными категориями
            //where('parent_id', 0) - получаем категории, которые являются только родителями и никому не подчиняются
            'categories' => Category::with('findChildrenCat')->where('parent_id', 0)->get(),
            
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
        $article = Article::create($request->all());
        
        //Проверка на наличие полученного от формы значения поля с name="categories"
        if($request->input('categories')) :
            //Присоединяем массив с выбранными для данной статьи категориями
            //Передаем в attach() массив категорий для присоединения
            $article->findCatForArticles()->attach($request->input('categories'));
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
          'categories' => Category::with('findChildrenCat')->where('parent_id', 0)->get(),
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
        $article->findCatForArticles()->detach();
        if($request->input('categories')) :
          $article->findCatForArticles()->attach($request->input('categories'));
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
        $article->findCatForArticles()->detach();
        //Удаляем экземпляр новости
        $article->delete();
        
        return redirect()->route('admin.article.index');
    }
}
