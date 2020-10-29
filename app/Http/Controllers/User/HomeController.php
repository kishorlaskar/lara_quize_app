<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $leadboard = DB::table('users')
            ->join('questions','users.q_id','=','questions.id')
            ->select('users.id','users.name','users.email','questions.answer')
            ->get();
        return view('admin.home.home')->with(['leadboard'=>$leadboard]);
//        return view('admin.home.home');
    }
}
