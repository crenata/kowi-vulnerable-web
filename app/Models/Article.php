<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "title",
        "image",
        "description",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getImageAttribute() {
        return env("APP_URL") . "/storage/articles/" . $this->attributes["image"];
    }
}
