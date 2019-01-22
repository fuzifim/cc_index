<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts_join extends Model
{
    protected $table = 'posts_join';
	public $timestamps = false;
	public function getPost(){
        return $this->hasOne('App\Model\Posts', 'id', 'posts_parent_id')->where('posts_status','=','active');
    }
	public function getSlug(){
        return $this->hasOne('App\Model\Slug', 'slug_table_id', 'posts_parent_id')->where('slug_table','=','posts');
    }
	public function getCategory(){
      return $this->hasOne('App\Model\Category', 'id', 'table_parent_id')->where('category_status', '=','active'); 
	 // return $this->hasManyThrough('App\Model\Posts_join', 'App\Model\Category', 'id', 'table_parent_id', 'posts_parent_id')->where('table', 'category');
    }
}
