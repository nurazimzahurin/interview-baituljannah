<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['title', 'comment', 'rating', 'product_id', 'reviewer_id', 'created_at', 'updated_at'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function reviewer()
    {
        return $this->belongsTo('App\User', 'reviewer_id', 'id');
    }
}
