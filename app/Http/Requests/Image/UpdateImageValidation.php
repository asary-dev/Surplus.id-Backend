<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class UpdateImageValidation extends Validation
{
    public static $rules = [
        "id" => ['required', 'numeric', 'max:255', 'exists:mysql.image,id'],
        "product_id" => ['required', 'string', 'max:255', 'exists:mysql.product,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        static::$rules = array_merge(static::$rules, CreateImageValidation::$rules);
        $request->merge(['id' => $request->id]);
        $request->merge(['product_id' => $request->product_id]);
        parent::__construct($request, $relations);
    }
}
