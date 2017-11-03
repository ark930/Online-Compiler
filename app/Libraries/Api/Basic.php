<?php

namespace App\Libraries\APi;


trait Basic
{
    public function createTerminal()
    {
        $response = $this->post("http://127.0.0.1:3000/terminals", []);

        return $response;
    }

    public function runCmd($pid, $cmd)
    {
        $response = $this->get("http://127.0.0.1:3000/terminals/$pid/cmd", [
            'cmd' => $cmd,
        ]);

        return $response;
    }
}