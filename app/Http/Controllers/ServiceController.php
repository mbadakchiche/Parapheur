<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Register;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Flash;

class ServiceController extends AppBaseController
{
    /** @var ServiceRepository $serviceRepository*/
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the Service.
     */
    public function index(Request $request)
    {
        $this->authorize('ViewAny', Service::class);
        return view('services.index');
    }

    /**
     * Show the form for creating a new Service.
     */
    public function create()
    {
        $this->authorize('Create', Service::class);
        return view('services.create');
    }

    /**
     * Store a newly created Service in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        $this->authorize('Create', Service::class);
        $input = $request->all();

        $service = $this->serviceRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/services.singular')]));

        return redirect(route('services.index'));
    }

    /**
     * Display the specified Service.
     */
    public function show($id)
    {
        $this->authorize('ViewAny', Service::class);
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified Service.
     */
    public function edit($id)
    {
        $this->authorize('Update', Service::class);
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        return view('services.edit')->with('service', $service);
    }

    /**
     * Update the specified Service in storage.
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $this->authorize('Update', Service::class);
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        $service = $this->serviceRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/services.singular')]));

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified Service from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('Delete', Service::class);
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('models/services.singular').' '.__('messages.not_found'));

            return redirect(route('services.index'));
        }

        $this->serviceRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/services.singular')]));

        return redirect(route('services.index'));
    }
}
