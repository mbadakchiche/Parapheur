<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Laracasts\Flash\Flash;

use App\Repositories\UserRepository;
use App\Http\Requests\UpdateProfileRequest;

class HomeController extends Controller
{
    private $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Home.home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showProfile()
    {
        return view('profile.home')->with('user',Auth::user());
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeProfile(UpdateProfileRequest $request, $id)
    {
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ];

       //dd($id);
        $user = $this->userRepository->update($data, $id);


        Flash::success(__('messages.updated', ['model' => __('models/users.singular')]));

        return redirect(route('profile.show'));
    }
}
