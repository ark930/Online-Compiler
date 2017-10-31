<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RunController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function run(Request $request)
    {
        $language = strtolower($request->get('language'));
        $code = $request->get('source');

        $tmpfname = tempnam(storage_path('app/public'), md5($code));
        $handle = fopen($tmpfname, "w");
        fwrite($handle, $code);
        fclose($handle);

        putenv('PATH=' . env('PATH'));

        $result = null;
        $error = null;
        if ($language == 'php') {
            $result = shell_exec("php $tmpfname");
        } else if ($language == 'c语言') {
            $sourceFile = "$tmpfname.c";
            $outFile = "$tmpfname.out";
            $result = shell_exec("cp $tmpfname $sourceFile");
            exec("gcc $sourceFile -o $outFile 2>&1", $output, $retval);
            unlink($sourceFile);

            if($retval !== 0) {
                $error = join("\n", $output);
                $files = explode('/', $sourceFile);
                $error = 'main.c' . explode($sourceFile, $error)[1];
                $result = null;
            } else {
                $result = shell_exec($outFile);
                unlink($outFile);
            }
        } else if ($language == 'c++') {
            $sourceFile = "$tmpfname.cpp";
            $outFile = "$tmpfname.out";
            $result = shell_exec("cp $tmpfname $sourceFile");
            $result = shell_exec("g++ $sourceFile -o $outFile");

            exec("g++ $sourceFile -o $outFile 2>&1", $output, $retval);
            unlink($sourceFile);

            if($retval !== 0) {
                $error = join("\n", $output);
                $files = explode('/', $sourceFile);
                $error = 'main.cpp' . explode($sourceFile, $error)[1];
                $result = null;
            } else {
                $result = shell_exec($outFile);
                unlink($outFile);
            }
        } else if ($language == 'java') {
            $result = shell_exec("java $tmpfname");
        } else if ($language == 'python2.7') {
            $result = shell_exec("python2.7 $tmpfname");
        } else if ($language == 'python3') {
            $result = shell_exec("python3 $tmpfname");
        }

        unlink($tmpfname);

        return response()->json([
            'result' => htmlentities($result),
            'error' => $error
        ]);
    }
}
