<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class CreateImageValidation extends Validation
{

    public static $rules = [
        "name" => ['required', 'string', 'max:255'],
        "image" => 'required|image|mimes:png,jpg,jpeg',
        "product_id" => ['required', 'numeric', 'exists:mysql.product,id'],

    ];

    public function __construct(Request $request, array $relations = [])
    {
        $request->merge(['product_id' => $request->product_id]);
        parent::__construct($request, $relations);
    }
}
