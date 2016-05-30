<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        // 'subtitle',
        'link',
    	'description',
    	'media_path',
        // 'access',
    	'categories_id'
    ];

    /**
     * The categories_tips that belong to the tip.
     */
    public function categories_tips(){
        return $this->belongsTo('HepC\Models\CategoriesTips', 'categories_id');
    }
}
