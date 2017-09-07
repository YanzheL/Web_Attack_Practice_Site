<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateCtl extends Controller
{
    public function processor(Request $request)
    {
        $rules = [
            'template_dir' => [
                'required',
                'string',
//                'regex:\.{0,2}(/(\.{0,2}|[a-zA-Z0-9_-]*))+'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            return redirect()->back()->with('template_dir', $request->input('template_dir'));
        } else {
            return redirect()->back()->withErrors($validator->errors());
        }
    }
}
