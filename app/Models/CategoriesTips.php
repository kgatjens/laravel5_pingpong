<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesTips extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'description',
    	'icon_path'
    ];
    protected $table = 'categories_tips';

    public function tips(){
        return $this->hasMany('HepC\Models\Tips', 'categories_id');
    }

    /**
     * Check if there are not tips associated to the categories
     *
     * @var array
     */
    public function getcanDeleteAttribute($category_id){
    	// get the releated tips
		$tips = Tips::where('categories_id', $category_id)->get();

		if (count($tips) == 0){
			return true;
		}else{
			return false;
		}
	}
}
