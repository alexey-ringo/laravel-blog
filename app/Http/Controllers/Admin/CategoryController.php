<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * Отображение списка всех категорий
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::paginate(7)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *  Открытие формы создания категорий
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', [    
        'category' => [],
            
        //categories - дерево коллекций
        //with('childrenCat') - коллекции с вложенными категориями - жадная загрузка
        //where('parent_id', 0) - получаем категории, которые являются только родителями и никому не подчиняются
        'categories' => Category::with('childrenCat')->where('parent_id', 0)->get(),
            
        //Некий символ, определяющий вложенность. Для наглядности визуализации
        'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Сохранение вновь созданных категорий (создание новой записи в таблице)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Метод для массового заполнения аттрибутов модели
        Category::create($request->all());
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     * Отображение выбранной категории
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Открытие формы редактирования категорий
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [    
        'category' => $category,
            
            //categories - дерево коллекций, переданное из index.blade.php
            //with('childrenCat') - коллекции с вложенными категориями - жадная загрузка
            //where('parent_id', 0) - получаем категории, которые являются только родителями и никому не подчиняются
            'categories' => Category::with('childrenCat')->where('parent_id', 0)->get(),
            
            //Некий символ, определяющий вложенность. Для наглядности визуализации
            'delimiter' => ''
            ]);
    }

    /**
     * Update the specified resource in storage.
     * Запись всех обновлений в таблицу БД
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //поле 'slug' исключаем из изменений
        $category->update($request->except('slug'));
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     * Удаление категории
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.category.index');
    }
}
