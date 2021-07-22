<?php

namespace App\Http\Controllers;
use App\Familia;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->type != 'user'){
            return redirect("/tickets");
        }
        return view('general.index');
    }

    public function test()
    {
        $familias = Familia::all();

        foreach ($familias as $familia) {
            echo $familia->nombre . '<br><br>' ;
            foreach ($familia->conceptos as $concepto) { echo $concepto->nombre . "<br>"; }
            echo "<br>";
            foreach ($familia->fallas as $falla) { echo $falla->nombre . "<br>"; }
            echo "<br>*************************************<br>";
        }

    }
}
