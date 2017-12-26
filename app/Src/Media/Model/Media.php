<?php

namespace Mulidev\Src\Media\Model;

use Illuminate\Database\Eloquent\Model;
use Mulidev\Src\Category\Model\Category;
use Mulidev\Src\Lang\Model\Lang;
use Mulidev\Src\User\Model\User;

class Media extends Model
{

    protected $table = 'media';

    protected $fillable = [
        'user_id',
        'category_id',
        'lang_id',
        'title',
        'description',
        'url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function category()
    {
        $this->belongsTo(Category::class);

    }

    public function lang()
    {
        $this->belongsTo(Lang::class);
    }
}
