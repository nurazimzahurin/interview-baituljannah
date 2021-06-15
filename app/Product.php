<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = ['name', 'description', 'currency', 'price', 'author_id', 'stock', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['overall_rating'];

    public function getOverallRatingAttribute()
    {
        $reviews = $this->reviews();
        if ($reviews->count() < 1) {
            return 0;
        }
        $totalReviews = $reviews->count();
        $totalRatings = $reviews->sum('rating');

        return round($totalRatings / $totalReviews);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function setCurrencyAttribute($value)
    {
        $this->attributes['currency'] = strtoupper($value);
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'product_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
}
