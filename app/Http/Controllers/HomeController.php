<?php namespace App\Http\Controllers;

use App\PermExp;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Comparator\ArrayComparatorTest;
use Request;

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

    /**
     * Show the 'account page' for the 'user' with 'user()->id'
     *
     * @return $this
     */
    public function show()
    {
        if (\Auth::check()) {
            $user_id = \Auth::user()->id;

            $avatar = \Auth::user()->gravatar;

            $select = DB::select('SELECT * FROM users WHERE id = ?', [$user_id]);

            // merging select from db Array with gravatar in one Array
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
    public function store()
    {
        if (Request::ajax()) {
            // Setup the validator rules
            /*$rules = [
                'title' => 'required|min:3|max:64',
                'amount' => 'required|numeric'
            ];*/

            /* create custom validation messages
            $messages = array(
                'required' => 'The :attribute is really really really important.', // !important :attribute
                'same'  => 'The :others must match.' // !important :others
            );*/

            // Validate requested data from inputs form
            // also it is possible to ModelName::$rules instead of $rules -- look at PermExp.php
            $validator = Validator::make(Input::all(), PermExp::$rules); //.., $rules, $messages

            // Validate the input and return correct response
            if ($validator->fails()) {

                return Response::json([
                    'success' => false,
                    'errors' => $validator->messages()
                ], 400); // 400 being the HTTP code for an invalid request.

                /* or without json
                $messages = $validator->messages();

                return Redirect::to('my_view')
                    ->withErrors($validator)
                    ->withInput(Input::except('password', 'password_confirm'));
                    // with old inputs value="{{ old('field') }}", except passwords
                */

                /* in the view!
                in order to show each error separate
                @if ($errors->has('field')) <p class="help-block">{{ $errors->first('field') }}</p> @endif*/

            } else {

                /*$perm_exp = new PermExp;
                $perm_exp->title = Input::get('title');
                $perm_exp->amount = Input::get('amount');

                $perm_exp->save();*/

                $input = Request::all();

                PermExp::create($input);

                return Response::json([
                    'success' => true,
                    'title' => $input['title'],
                    'amount' => $input['amount']
                ], 200);

                // or without json
                //return Redirect::to('my_view');
            }
        } abort(404);
    }

    /**
     * Method for TESTING ...
     * @param num or any other
     * @return string
     */
    public function test($var)
    {
        $user = User::findOrFail($var);

        if (is_null($user)) {
            abort(404);
        }

        return number_format($var, 2, ',', ' ');
    }

}