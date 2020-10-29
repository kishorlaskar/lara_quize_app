<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class MainController extends Controller
{
    public function index()
    {
        return view('admin.quize.start');
    }
    public  function  startquiz()
    {
        Session::put('nextq',1);
        Session::put('wrongans',0);
        Session::put('correctans',0);

        $q = Question::all()->first();
        return view('admin.quize.answer')->with(['q'=>$q]);

    }
    public function submitans(Request $request)
    {
        $nextq =      Session::get('nextq');
        $wrongans =   Session::get('wrongans');
        $correctans = Session::get('correctans');

        $request->validate
        ([
            'answer'=> 'required',
            'dbans' => 'required',
        ]);

        $nextq+=1;
        if ($request->dbans == $request->answer)
        {
            $correctans+=1;
        }
        else
        {
            $wrongans+=1;
        }
        Session::put("nextq",$nextq);
        Session::put("wrongans",$wrongans);
        Session::put("correctans",$correctans);

        $i=0;

        $questions = Question::all();

        foreach ($questions as $question)
        {
            $i++;
            if($questions->count() < $nextq)
            {
                return view('admin.quize.end');
            }
            if ($i==$nextq)
            {
                return view('admin.quize.answer')->with(['q'=>$question]);
            }
        }

    }
//    public  function leadboard()
//    {
//
//    }
}
