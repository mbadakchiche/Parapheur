<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Action;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     */
    public function index(Request $request)
    {
        $this->authorize('ViewAny', User::class);
        return view('users.index');
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        $this->authorize('Create', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $this->authorize('Create', User::class);
        $input = $request->all();

        $user = $this->userRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     */
    public function show($id)
    {
        $this->authorize('ViewAny', User::class);
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('models/users.singular').' '.__('messages.not_found'));

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     */
    public function edit($id)
    {
        $this->authorize('Update', User::class);
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('models/users.singular').' '.__('messages.not_found'));

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->authorize('Update', User::class);

        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('models/users.singular').' '.__('messages.not_found'));

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('Delete', User::class);
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(__('models/users.singular').' '.__('messages.not_found'));

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }
}
