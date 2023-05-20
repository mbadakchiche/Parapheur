<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\CreateMailRequest;
use App\Http\Requests\UpdateMailRequest;
use App\Models\Mail;
use App\Models\Register;
use App\Repositories\MailRepository;
use App\Repositories\ServiceRepository;
use Auth;
use Flash;
use Illuminate\Http\Request;

class MailController extends AppBaseController
{
    /** @var MailRepository $mailRepository*/
    private MailRepository $mailRepository;

    public function __construct(MailRepository $mailRepo)
    {
        $this->mailRepository = $mailRepo;
    }

    /**
     * Display a listing of the Mail.
     */
    public function index(Request $request)
    {
        $this->authorize('ViewAny', arguments: Mail::class);
        return view('mails.index');
    }

    /**
     * Show the form for creating a new Mail.
     */
    public function create()
    {
        $this->authorize('create', arguments: Mail::class);
        return view('mails.create');
    }

    /**
     * Store a newly created Mail in storage.
     */
    public function store(CreateMailRequest $request)
    {
        $this->authorize('create', arguments: Mail::class);
        $input = $request->all();
        $input['service_id'] = Auth::user()->service_id;

        $mail = $this->mailRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.index'));
    }

    /**
     * Display the specified Mail.
     */
    public function show($id)
    {
        $this->authorize('ViewAny', arguments: Mail::class);


        $mail = $this->mailRepository->find($id);
        $pivot = $mail->registers()->first();

        $returned =[
            'mail'=>$mail,
            'pivot'=>$pivot
        ];

        if(!empty($pivot->pivot->orientation_data)){
            $data = json_decode($pivot->pivot->orientation_data);

            $receivers = [];
            foreach ($data as $key => $value) {
                $column = 'name_' . App::getLocale();
                $service = (new ServiceRepository())->find($value);
                $receivers [$key] = $service->$column;
            }

            $returned['receivers'] = $receivers;
            $returned['orientations'] = $pivot->pivot->orientation_text;
        }

        if (empty($mail)) {
            Flash::error(__('models/mails.singular') . ' ' . __('messages.not_found'));

            return redirect(route('mails.index'));
        }
       // dd($returned);
        return view('mails.show')->with('data',$returned);
    }

    /**
     * Show the form for editing the specified Mail.
     */
    public function edit($id)
    {

        $this->authorize('update', arguments: Mail::class);

        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        return view('mails.edit')->with('mail', $mail);
    }

    /**
     * Update the specified Mail in storage.
     */
    public function update($id, UpdateMailRequest $request)
    {
        $this->authorize('update', arguments: Mail::class);

        $mail = $this->mailRepository->find($id);
        //dd($mail);
        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        $mail = $this->mailRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.index'));
    }

    /**
     * Remove the specified Mail from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->authorize('delete', arguments: Mail::class);
        $mail = $this->mailRepository->find($id);

        if (empty($mail)) {
            Flash::error(__('models/mails.singular').' '.__('messages.not_found'));

            return redirect(route('mails.index'));
        }

        $this->mailRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/mails.singular')]));

        return redirect(route('mails.index'));
    }
}
