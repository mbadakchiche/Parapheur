<?php

namespace App\Http\Controllers;

use App;
use App\Repositories\MailRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use App\Services\CirculationService;
use Auth;
use Flash;
use Illuminate\Http\Request;

class CirculationController extends AppBaseController
{
    /** @var MailRepository $mailRepository*/
    private $mailRepository;

    private $circulationService;

    public function __construct(MailRepository $mailRepo, CirculationService $circulationService)
    {
        $this->mailRepository = $mailRepo;
        $this->circulationService = $circulationService;
    }


    /**
     * Show the specified Mail to record it in register.
     */
    public function recordInRegister($id)
    {
        $this->authorize('record',App\Models\circulation::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        return view('circulation.record.form')->with('mail', $mail);
    }

    /**
     * Show all Dossier to choose oon for attaching.
     */
    public function attach($id)
    {
        $this->authorize('update',App\Models\Mail::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        return view('circulation.attach.form')->with('mail', $mail);
    }

    /**
     * Record specified Mail to  register.
     */
    public function updateAttach($id, Request $request)
    {
        $this->authorize('update',App\Models\Mail::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        $this->circulationService->updateAttach($mail, $request);

        Flash::success(__('messages.updated', ['model' => __('models/mails.singular')]));

        return back();
    }


    /**
     * Record specified Mail to  register.
     */
    public function storeRecorded($id, Request $request)
    {
        $this->authorize('record',App\Models\circulation::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        $this->circulationService->storeRecorded($mail, $request);

        Flash::success(__('messages.updated', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.search.arrived'));
    }




    /**
     * Show the specified Mail to send it to its distinction.
     */
    public function send($id)
    {
        $this->authorize('send',App\Models\circulation::class);

        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular') . ' ' . __('messages.not_found'));

            return redirect(route('mails.index'));
        }

        return view('circulation.send.form')->with('mail', $mail);
    }

    /**
     * Show the specified Mail to send it to its distinction.
     */
    public function SendProcessing($id)
    {
        $this->authorize('dispatch',App\Models\circulation::class);
        $mail = $this->mailRepository->find($id);
        $pivot = $mail->processMailInRegisters(Auth::user()->service_id)->first();
        $data = json_decode($pivot->pivot->processed_data);
        $receivers = [];
        foreach ($data as $key => $value)
        {
            $column = 'name_'.App::getLocale();
            $service = (new ServiceRepository())->find($value);
            $receivers [$service->id] = $service->$column;
        }

        $orientations = $pivot->pivot->processed_orientations;


        if (empty($mail)) {
            Flash::error(__('models/mails.singular') . ' ' . __('messages.not_found'));

            return redirect(route('mails.index'));
        }

        return view('circulation.send_process.form')
                    ->with('mail', $mail)
                    ->with('pivot', $pivot)
                    ->with('orientations', $orientations)
                    ->with('receivers',$receivers);
    }

    /**
     * Show the specified Mail to send it to its distinction.
     */
    public function storeSendProcessing($id, Request $request)
    {
        $this->authorize('dispatch',App\Models\circulation::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular') . ' ' . __('messages.not_found'));

            return redirect(route('mails.index'));
        }

        $this->circulationService->storeSendProcessing($mail, $request);

        Flash::success(__('messages.updated', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.search.needdispatch'));

    }
    /**
     * Store sent  Mail  to its distinction.
     */
    public function storeSended($id, Request $request)
    {
        $this->authorize('send',App\Models\circulation::class);
        // find mail
        $mail = $this->mailRepository->find($id);
        if (empty($mail)) {
            Flash::error(__('models/mails.singular') . ' ' . __('messages.not_found'));

            return redirect(route('mails.index'));
        }

        $this->circulationService->send($mail, $request);
        // send mail to Circulation service for save it with the request.

        Flash::success(__('messages.updated', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.index'));

    }


    /**
     * Show the specified Mail for officer processing .
     */
    public function processing($id)
    {
        $this->authorize('process',App\Models\circulation::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        return view('circulation.process.form')->with('mail', $mail);
    }

    /**
     * store Processing action by the Manager
     * @param $id
     * @return void
     */
    public function storeProcessing($id, Request $request)
    {
        $this->authorize('process',App\Models\circulation::class);
        // find mail
        $mail = $this->mailRepository->find($id);
        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.search.needprocess'));
        }

        $mail = $this->circulationService->storeProcessing($mail, $request);


        Flash::success(__('messages.updated', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.search.needprocess'));
    }

}
