<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Models\Action;
use App\Models\Register;
use App\Repositories\RegisterRepository;
use Flash;
use Illuminate\Http\Request;

class RegisterController extends AppBaseController
{
    /** @var RegisterRepository $registerRepository*/
    private $registerRepository;

    public function __construct(RegisterRepository $registerRepo)
    {
        $this->registerRepository = $registerRepo;
    }

    /**
     * Display a listing of the Register.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Register::class);

        return view('registers.index');
    }

    /**
     * Show the form for creating a new Register.
     */
    public function create()
    {
        $this->authorize('Create', Register::class);
        return view('registers.create');
    }

    /**
     * Store a newly created Register in storage.
     */
    public function store(CreateRegisterRequest $request)
    {
        $this->authorize('Create', Register::class);
        $input = $request->all();

        $register = $this->registerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/registers.singular')]));

        return redirect(route('registers.index'));
    }

    /**
     * Display the specified Register.
     */
    public function show($id)
    {
        $this->authorize('ViewAny', Register::class);
        $register = $this->registerRepository->find($id);

        if (empty($register)) {
            Flash::error(__('models/registers.singular').' '.__('messages.not_found'));

            return redirect(route('registers.index'));
        }

        return view('registers.show')->with('register', $register);
    }

    /**
     * Show the form for editing the specified Register.
     */
    public function edit($id)
    {
        $this->authorize('Update', Register::class);
        $register = $this->registerRepository->find($id);

        if (empty($register)) {
            Flash::error(__('models/registers.singular').' '.__('messages.not_found'));

            return redirect(route('registers.index'));
        }

        return view('registers.edit')->with('register', $register);
    }

    /**
     * Update the specified Register in storage.
     */
    public function update($id, UpdateRegisterRequest $request)
    {
        $this->authorize('Update', Register::class);
        $register = $this->registerRepository->find($id);

        if (empty($register)) {
            Flash::error(__('models/registers.singular').' '.__('messages.not_found'));

            return redirect(route('registers.index'));
        }

        $register = $this->registerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/registers.singular')]));

        return redirect(route('registers.index'));
    }

    /**
     * Remove the specified Register from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('Delete', Register::class);
        $register = $this->registerRepository->find($id);

        if (empty($register)) {
            Flash::error(__('models/registers.singular').' '.__('messages.not_found'));

            return redirect(route('registers.index'));
        }

        $this->registerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/registers.singular')]));

        return redirect(route('registers.index'));
    }
}
