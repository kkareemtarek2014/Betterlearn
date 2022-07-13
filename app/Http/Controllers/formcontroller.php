<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;

class formcontroller extends Controller
{
    function newdata(Request $arg,$cvv,$name,$date)
    {

    $arg-> input('card-num');
    $process = new Process(['python', 'app\Python\ClientSide(1).py', $arg]);
    $process->run();

    $name-> input('card-name');
    $process = new Process(['python', 'app\Python\ClientSide(1).py', $name]);
    $process->run();

    $date-> input('expire');
    $process = new Process(['python', 'app\Python\ClientSide(1).py', $date]);
    $process->run();

    $cvv-> input('security');
    $process = new Process(['python', 'app\Python\ClientSide(1).py', $cvv]);
    $process->run();


    // error handling
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    $output_data = $process->getOutput();
}
}
