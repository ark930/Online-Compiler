<?php

namespace App\Libraries\APi;


trait Basic
{
    public function createTerminal()
    {
        $response = $this->post("/terminals", []);

        return $response;
    }

    public function runCmd($pid, $cmd)
    {
        $response = $this->get("/terminals/$pid/cmd", [
            'cmd' => $cmd,
        ]);

        return $response;
    }
}