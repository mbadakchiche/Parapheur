<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParafeureRequest;
use App\Http\Requests\UpdateParafeureRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ParafeureRepository;
use Illuminate\Http\Request;
use Flash;

class ParafeureController extends AppBaseController
{
    /** @var ParafeureRepository $parafeureRepository*/
    private $parafeureRepository;

    public function __construct(ParafeureRepository $parafeureRepo)
    {
        $this->parafeureRepository = $parafeureRepo;
    }

    /**
     * Display a listing of the Parafeure.
     */
    public function index(Request $request)
    {
        return view('parafeures.index');
    }

    /**
     * Show the form for creating a new Parafeure.
     */
    public function create()
    {
        return view('parafeures.create');
    }

    /**
     * Store a newly created Parafeure in storage.
     */
    public function store(CreateParafeureRequest $request)
    {
        $input = $request->all();

        $parafeure = $this->parafeureRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/parafeures.singular')]));

        return redirect(route('parafeures.index'));
    }

    /**
     * Display the specified Parafeure.
     */
    public function show($id)
    {
        $parafeure = $this->parafeureRepository->find($id);

        if (empty($parafeure)) {
            Flash::error(__('models/parafeures.singular').' '.__('messages.not_found'));

            return redirect(route('parafeures.index'));
        }

        return view('parafeures.show')->with('parafeure', $parafeure);
    }

    /**
     * Show the form for editing the specified Parafeure.
     */
    public function edit($id)
    {
        $parafeure = $this->parafeureRepository->find($id);

        if (empty($parafeure)) {
            Flash::error(__('models/parafeures.singular').' '.__('messages.not_found'));

            return redirect(route('parafeures.index'));
        }

        return view('parafeures.edit')->with('parafeure', $parafeure);
    }

    /**
     * Update the specified Parafeure in storage.
     */
    public function update($id, UpdateParafeureRequest $request)
    {
        $parafeure = $this->parafeureRepository->find($id);

        if (empty($parafeure)) {
            Flash::error(__('models/parafeures.singular').' '.__('messages.not_found'));

            return redirect(route('parafeures.index'));
        }

        $parafeure = $this->parafeureRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/parafeures.singular')]));

        return redirect(route('parafeures.index'));
    }

    /**
     * Remove the specified Parafeure from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $parafeure = $this->parafeureRepository->find($id);

        if (empty($parafeure)) {
            Flash::error(__('models/parafeures.singular').' '.__('messages.not_found'));

            return redirect(route('parafeures.index'));
        }

        $this->parafeureRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/parafeures.singular')]));

        return redirect(route('parafeures.index'));
    }
}
