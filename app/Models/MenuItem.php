<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'slug',
        'url',
        'target',
        'custom_class',
        'author_id',
        'menu_id',
        'parent',
        'order',
    ];

    public function getMenu()
    {
        $menu = Menu::where('id', $this->menu_id)->first();

        return $menu;
    }

    public function getParent()
    {
        $parent = MenuItem::find($this->parent);

        return $parent;
    }

    public function getAuthor()
    {
        $author = User::find($this->author_id);

        return $author;
    }

    public function getSubItems()
    {
        $items = MenuItem::where('parent', $this->id)->orderBy('order', 'ASC')->get();

        return $items;
    }
}
