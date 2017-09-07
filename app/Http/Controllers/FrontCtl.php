<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Article;

class FrontCtl extends Controller
{

    public function processor(Request $request)
    {
        $rules = [
            'search_type' => [
                'bail',
                'required',
                'string',
                Rule::in([
                    'title',
                    'article_id',
                    'author'
                ])
            ],
            'search_content' => [
                'required',
                'max:255',
//                'cstm_sql_filter'
            ]
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->sometimes('search_content', 'alpha_num', function ($request) {
            return $request->get('search_type') == 'article_id';
        });
        if ($validator->passes()) {
            $query_field = $request->input('search_type');
            if ($query_field == 'article_id') {
                $query_field = 'id';
            }

            $query_value = self::cstmSqlFilter($request->input('search_content'));
            echo $query_value;
            switch ($query_field) {
                case 'id':
                    $matched_articles = Article::where('id', '=', $query_value)->get();
                    break;
                case 'title':
                    $matched_articles = Article::where('title', 'LIKE', '%' . $query_value . '%')->get();
                    // $matched_articles = DB::table('articles')->where($query_field, 'like', '%' . $query_value . '%')->get();
                    break;
                case 'author':
                    // $matched_articles = DB::table('articles')->whereRaw("author='${query_value}'")->get();
                    // echo $query_value;
                    $matched_articles = DB::select("select * from articles where author='${query_value}'");
                    break;
            }
//             var_dump($matched_articles);
            // die();
            return redirect()->back()->with('fetched_data', $matched_articles);
        } else {
            return redirect()->back()->withErrors($validator->errors());
        }
    }

    static function cstmSqlFilter($str)
    {
        $danger = [
            'select',
            'union',
            'delete',
            'updata',
            'insert',
            'replace',
            'into',
            'shell',
            'and',
            'or',
            '&',
            ' l',
            '#',
            '--',
            'from',
            'where',
            'load_file',
            'outfile',
            ' '
        ];
        return str_replace($danger, '', strtolower($str));
    }
}