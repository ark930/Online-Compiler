<?php

namespace App\Http\Controllers;

use App\Libraries\APi\Api;
use Illuminate\Http\Request;

class RunController extends Controller
{
    public function index(Request $request)
    {
        $api = new Api();
        $pid = $api->createTerminal();
        $request->session()->put('pid', $pid);

        return view('index');
    }

    public function run(Request $request)
    {
        $pid = $request->session()->get('pid');

        $language = strtolower($request->get('language'));
        $code = $request->get('code');

        $tmpfname = tempnam(storage_path('app/public'), md5($code));
        $handle = fopen($tmpfname, "w");
        fwrite($handle, $code);
        fclose($handle);

        putenv('PATH=' . env('PATH'));

        $result = null;
        $error = null;
        $api = new Api();
        $targetPath = storage_path('app/public');

        if ($language == 'php') {
            $api->runCmd($pid, "php $tmpfname");
        } else if ($language == 'c语言') {
            $sourceFile = "$tmpfname.c";
            $outFile = "$tmpfname.out";

            shell_exec("cd $targetPath");
            shell_exec("cp $tmpfname $sourceFile");
            exec("gcc $sourceFile -o $outFile 2>&1", $output, $retval);
            unlink($sourceFile);
            unlink($tmpfname);

            if($retval !== 0) {
                $error = join("\n", $output);
                $error = str_replace($sourceFile, 'main.c', $error);
                $result = null;
            } else {
                $api->runCmd($pid, $outFile);
            }
        } else if ($language == 'c++') {
            $sourceFile = "$tmpfname.cpp";
            $outFile = "$tmpfname.out";

            shell_exec("cd $targetPath");
            shell_exec("cp $tmpfname $sourceFile");
            exec("g++ $sourceFile -o $outFile 2>&1", $output, $retval);
            unlink($sourceFile);
            unlink($tmpfname);

            if($retval !== 0) {
                $error = join("\n", $output);
                $error = str_replace($sourceFile, 'main.cpp', $error);
                $result = null;
            } else {
                $api->runCmd($pid, $outFile);
            }
        } else if ($language == 'java') {
            $result = shell_exec("java $tmpfname");
            unlink($tmpfname);
        } else if ($language == 'python2.7') {
            $api->runCmd($pid, "python2.7 $tmpfname");
        } else if ($language == 'python3') {
            $api->runCmd($pid, "python3 $tmpfname");
        }

        return response()->json([
            'result' => htmlentities($result),
            'error' => $error
        ]);
    }
}
