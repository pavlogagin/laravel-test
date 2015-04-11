<?php namespace App\Http\Controllers;

use App\PermExp;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Comparator\ArrayComparatorTest;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * Obtaining data from AJAX request via POST method
     *
     * @return string
     */
    public function post_action()
    {
        if (Session::token() !== Input::get('_token')) {
            return 'bad token:<br />' . Session::token() . '<br />' . Input::get('_token');
        }

        // Setup the validator
        $rules = array('title' => 'required', 'amount' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
        }

        $perm_exp = new PermExp;

        $perm_exp->title = Input::get('title');
        $perm_exp->amount = Input::get('amount');

        $perm_exp->save();

        return Response::json(array(
            'success' => true,
            'title' => Input::get('title'),
            'amount' => Input::get('amount')
        ), 200);
    }

    /**
     * Method for TESTING ...
     * @param $num or any alse
     * @return string
     */
    public function test($var)
    {
        return number_format($var, 2, ',', ' ');
    }

}
