<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Validation
{
    public static $rules = [];
    public static $messages = [
        'exists' => "Record does not exist.",
    ];
    public static $relations = [];

    public $status = false;
    public $message;
    public $data;
    public $rawInput;
    public $type;

    public function __construct(Request $request, array $relations = [])
    {
        $this->rawInput = $request->all();
        static::$relations = $relations;
        $this->validate();
    }

    public function validate()
    {
        $this->status = false;

        $input = Validator::make($this->rawInput, static::$rules, static::$messages);
        if ($input->stopOnFirstFailure()->fails()) {
            $this->message = $input->errors()->first();
        } else {
            $this->status = true;
            $this->data = $input->validated();
        }

        return $this;
    }
}
