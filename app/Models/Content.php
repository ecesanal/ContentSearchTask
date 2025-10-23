<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content','language_id'];

    public function language(){
        return $this->belongsTo(Language::class);
    }
        public static function search($query)
    {
        return self::whereRaw(
            "MATCH(title, content) AGAINST(? IN NATURAL LANGUAGE MODE)",
            [$query]
        )->get();
    }
}
