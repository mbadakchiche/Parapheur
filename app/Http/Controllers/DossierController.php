<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDossierRequest;
use App\Http\Requests\UpdateDossierRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Action;
use App\Models\Dossier;
use App\Repositories\DossierRepository;
use Illuminate\Http\Request;
use Flash;

class DossierController extends AppBaseController
{
    /** @var DossierRepository $dossierRepository*/
    private $dossierRepository;

    public function __construct(DossierRepository $dossierRepo)
    {
        $this->dossierRepository = $dossierRepo;
    }

    /**
     * Display a listing of the Dossier.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Dossier::class);
        return view('dossiers.index');
    }

    /**
     * Show the form for creating a new Dossier.
     */
    public function create()
    {
        $this->authorize('create', Dossier::class);
        return view('dossiers.create');
    }

    /**
     * Store a newly created Dossier in storage.
     */
    public function store(CreateDossierRequest $request)
    {
        $this->authorize('create', Dossier::class);
        $input = $request->all();

        $dossier = $this->dossierRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/dossiers.singular')]));

        return redirect(route('dossiers.index'));
    }

    /**
     * Display the specified Dossier.
     */
    public function show($id)
    {
        $this->authorize('view', Dossier::class);
        $dossier = $this->dossierRepository->find($id);

        if (empty($dossier)) {
            Flash::error(__('models/dossiers.singular').' '.__('messages.not_found'));

            return redirect(route('dossiers.index'));
        }

        return view('dossiers.show')->with('dossier', $dossier);
    }

    /**
     * Show the form for editing the specified Dossier.
     */
    public function edit($id)
    {
        $this->authorize('update', Dossier::class);
        $dossier = $this->dossierRepository->find($id);

        if (empty($dossier)) {
            Flash::error(__('models/dossiers.singular').' '.__('messages.not_found'));

            return redirect(route('dossiers.index'));
        }

        return view('dossiers.edit')->with('dossier', $dossier);
    }

    /**
     * Update the specified Dossier in storage.
     */
    public function update($id, UpdateDossierRequest $request)
    {
        $this->authorize('update', Dossier::class);
        $dossier = $this->dossierRepository->find($id);

        if (empty($dossier)) {
            Flash::error(__('models/dossiers.singular').' '.__('messages.not_found'));

            return redirect(route('dossiers.index'));
        }

        $dossier = $this->dossierRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/dossiers.singular')]));

        return redirect(route('dossiers.index'));
    }

    /**
     * Remove the specified Dossier from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('delete', Dossier::class);
        $dossier = $this->dossierRepository->find($id);

        if (empty($dossier)) {
            Flash::error(__('models/dossiers.singular').' '.__('messages.not_found'));

            return redirect(route('dossiers.index'));
        }

        $this->dossierRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/dossiers.singular')]));

        return redirect(route('dossiers.index'));
    }
}
