<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEtablissementRequest;
use App\Http\Requests\UpdateEtablissementRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Etablissement;
use App\Models\Service;
use App\Repositories\EtablissementRepository;
use Illuminate\Http\Request;
use Flash;

class EtablissementController extends AppBaseController
{
    /** @var EtablissementRepository $etablissementRepository*/
    private $etablissementRepository;

    public function __construct(EtablissementRepository $etablissementRepo)
    {
        $this->etablissementRepository = $etablissementRepo;
    }

    /**
     * Display a listing of the Etablissement.
     */
    public function index(Request $request)
    {
        $this->authorize('ViewAny', Etablissement::class);
        return view('etablissements.index');
    }

    /**
     * Show the form for creating a new Etablissement.
     */
    public function create()
    {
        $this->authorize('create', Etablissement::class);
        return view('etablissements.create');
    }

    /**
     * Store a newly created Etablissement in storage.
     */
    public function store(CreateEtablissementRequest $request)
    {
        $this->authorize('create', Etablissement::class);
        $input = $request->all();

        $etablissement = $this->etablissementRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/etablissements.singular')]));

        return redirect(route('etablissements.index'));
    }

    /**
     * Display the specified Etablissement.
     */
    public function show($id)
    {
        $this->authorize('view', Etablissement::class);
        $etablissement = $this->etablissementRepository->find($id);

        if (empty($etablissement)) {
            Flash::error(__('models/etablissements.singular').' '.__('messages.not_found'));

            return redirect(route('etablissements.index'));
        }

        return view('etablissements.show')->with('etablissement', $etablissement);
    }

    /**
     * Show the form for editing the specified Etablissement.
     */
    public function edit($id)
    {
        $this->authorize('update', Etablissement::class);
        $etablissement = $this->etablissementRepository->find($id);

        if (empty($etablissement)) {
            Flash::error(__('models/etablissements.singular').' '.__('messages.not_found'));

            return redirect(route('etablissements.index'));
        }

        return view('etablissements.edit')->with('etablissement', $etablissement);
    }

    /**
     * Update the specified Etablissement in storage.
     */
    public function update($id, UpdateEtablissementRequest $request)
    {
        $this->authorize('update', Etablissement::class);
        $etablissement = $this->etablissementRepository->find($id);

        if (empty($etablissement)) {
            Flash::error(__('models/etablissements.singular').' '.__('messages.not_found'));

            return redirect(route('etablissements.index'));
        }

        $etablissement = $this->etablissementRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/etablissements.singular')]));

        return redirect(route('etablissements.index'));
    }

    /**
     * Remove the specified Etablissement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('delete', Etablissement::class);
        $etablissement = $this->etablissementRepository->find($id);

        if (empty($etablissement)) {
            Flash::error(__('models/etablissements.singular').' '.__('messages.not_found'));

            return redirect(route('etablissements.index'));
        }

        $this->etablissementRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/etablissements.singular')]));

        return redirect(route('etablissements.index'));
    }
}
