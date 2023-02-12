<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class UpdateCategoryValidation extends Validation
{
    public static $rules = [
        "id" => ['required', 'numeric', 'exists:mysql.category,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        static::$rules = array_merge(static::$rules, CreateCategoryValidation::$rules);
        $request->merge(['id' => $request->id]);
        parent::__construct($request, $relations);
    }
}
