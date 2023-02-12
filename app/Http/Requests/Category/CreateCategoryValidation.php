<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class CreateCategoryValidation extends Validation
{

    public static $rules = [
        "name" => ['required', 'string', 'max:255'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        parent::__construct($request, $relations);
    }
}
