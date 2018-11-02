<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Category extends Model
{
    // Mass assigned - поля, разрешенные для массового присваивания
    protected $fillable = ['title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by'];
    // Mutators - преобразователь значения полей перед записью в БД
    //автоматическое формирование уникального значения поля slug из title
    //'set' - установить наименование, 'Slug' - название поля и Attribute. В соответсвии со стандартом
    public function setSlugAttribute($value) {
        //Второй параметр для Str::slug - что будем использовать вместо пробелов при генерации Slug
        $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }
    
    //Поиск вложенных категорий (по полю parent_id)
    //Связь "один к многим" на свою же модель
    public function childrenCat() {
        return $this->hasMany(self::class, 'parent_id');
    }
}
