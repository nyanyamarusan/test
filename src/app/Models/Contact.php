<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static $genderLabels = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];

    public function scopeKeywordSearch($query, $keyword)
    {
    if (!empty($keyword)) {
        return $query->where(function ($q) use ($keyword) {
            $q->where('first_name', 'LIKE', '%' . $keyword . '%')
              ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
              ->orWhere('email', 'LIKE', '%' . $keyword . '%');
        });
    }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
            return $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            return $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            return $query->whereDate('created_at', $date);
        }
    }
}