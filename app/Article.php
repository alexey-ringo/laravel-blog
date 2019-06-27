<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

use Illuminate\Support\Str;

class Article extends Model
{
    // Mass assigned
    protected $fillable = ['title', 'slug', 'description_short', 'description', 'image', 'image_show', 
    'meta_title', 'meta_description', 'meta_keyword', 'published', 'created_by', 'modified_by'];
    
    // Mutators - преобразователь значения полей перед записью в БД
    //автоматическое формирование уникального значения поля slug из title
    //'set' - установить наименование, 'Slug' - название поля и Attribute. В соответсвии со стандартом
    public function setSlugAttribute($value) {
        //Второй параметр для Str::slug - что будем использовать вместо пробелов при генерации Slug
        $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }
    
    //Polimorphic relations with categories - 
    //Полисорфная связь модели Article с категориями
    public function categoriesToArticles() {
        //'categoryable' - префикс для связных таблиц в названии полей таблицы categoryables
        //т.н. 'categoryable' - но без '_id'
        return $this->morphToMany('App\Category', 'categoryable');
    }
    
    public function users() {
      return $this->belongsTo(User::class, 'id');
    }
    
    public function scopeLastArticles($query, $count)
    {
      return $query->orderBy('created_at', 'desc')->take($count)->get();
    }
}
