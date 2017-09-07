<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UploadCtl extends Controller
{

    public function processor(Request $request)
    {
        $rules = [
            'upload_from' => [
                'bail',
                'required',
                'string',
                'max:10',
                Rule::in([
                    'admin'
                ])
            ],
            'upload_purpose' => [
                'bail',
                'required',
                'string',
                'max:10',
                Rule::in([
                    'avatar',
                    'public'
                ])
            ],
            'upload_content' => [
                'required',
                'file'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            switch ($request->input('upload_from')) {
                case 'admin':
                    return $this->adminFileProcessor($request);
            }
        } else {
            $errors = $validator->errors();

            // return response()->json([
            // 'errors' => $errors
            // ]);
            return redirect()->back()->withErrors($errors);
        }
    }

    protected function adminFileProcessor(Request $request)
    {
        if (!(Auth::guard()->check() && Auth::user()->email == 'test36@test.test')) {
            return view('fakelogin');
        }

        $rules = [
            'upload_content' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,bmp,png,gif',
                'max:20480'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            switch ($request->input('upload_purpose')) {
                case 'avatar':
                    $file = $request->file('upload_content');
                    $filename = $file->getClientOriginalName();
                    // $path = $request->file('upload_content')->storeAs('public/avatars', $filename);
                    $path = $request->file('upload_content')->store('public/avatars');
                    // return app_path();
                    // Log::alert("数据库访问异常");
//                    include(storage_path('app'));
                    // File::requireOnce(storage_path($path));
//                    include('/home/vagrant/Code/learnlaravel5/storage/app/public/avatars');
                    // return $path;
                    $urlpath = Storage::url($path);
                    // return response()->json([
                    // 'path' => $path
                    // ]);
                    return redirect()->back()->with('status', $urlpath);
            }
        } else {
            $errors = $validator->errors();

            // return response()->json([
            // 'errors' => $errors
            // ]);

            return redirect()->back()->withErrors($errors);
        }
    }
}
