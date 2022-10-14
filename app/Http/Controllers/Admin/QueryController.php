<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QueryController extends Controller
{
    public function __invoke(Request $request)
    {
        $results = null;
        $validated = Validator::make($request->all(), [
            'sql' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use (&$results) {
                    try {
                        $results = DB::select($value);
                    } catch (QueryException $e) {
                        $fail("SQL 表达式异常：" . $e->getMessage());
                    }
                },
            ],
        ])->validateWithBag('query');
        return view('admin.query', [
            'sql' => $validated['sql'],
            'results' => $results,
        ]);
    }
}
