<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $codes = $user->codes()
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return response()->json($codes);
    }

    public function create(Request $request)
    {
        $language = $this->languageFilter($request->get('language'));
        $codeText = $request->get('code');
        $filename = $request->get('filename');

        $code = new Code();
        $code['language'] = $language;
        $code['code'] = $codeText;
        $code['filename'] = $filename;

        $user = $request->user();
        $user->codes()->save($code);

        return response($code);
    }

    protected function languageFilter($language)
    {
        switch ($language) {
            case 'C语言':
                $language = 'c';
                break;
            case 'Python2.7':
                $language = 'python27';
                break;
            default:
                $language = strtolower($language);
        }

        return $language;
    }
}
