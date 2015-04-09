<?php namespace App\Http\Controllers;

use App\PermExp;
use App\User;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Comparator\ArrayComparatorTest;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

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
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $perm_exps = PermExp::all();

        return view('home')->with([
            'perm_exps' => $perm_exps
        ]);
    }

    public function account()
    {
        if (\Auth::check()) {
            $user_id = \Auth::user()->id;

            $avatar = \Auth::user()->gravatar;

            $select = DB::select('SELECT * FROM users WHERE id = ?', [$user_id]);

            $select[0] = (object)array_merge((array)$select[0], array('avatar' => $avatar));
        }

        return view('account')->with([
            'user_id' => $user_id,
            'gravatar' => $avatar,
            'select' => $select
        ]);
    }

}
