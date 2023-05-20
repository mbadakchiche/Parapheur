<?php

namespace App\Services;

use App\Models\Mail;
use App\Models\Scopes\ServiceScope;
use App\Repositories\RegisterRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;


class CirculationService
{


    private function preparreData(array $data, $key): array
    {
        $data[$key] = json_encode($data[$key]);
        return $data;
    }


    public function updateAttach(Mail $mail, Request $request): Mail
    {
        //TODO Update Dossier Id in Mail
        $mail->update(['dossier_id'=>$request->dossier_id]);
        return $mail;
    }

    private function createReceivers(Request $request): array
    {
        $register_id = $request->register_id;
        $tmp = [];
        $data = $request->validate([
            'receiver_id.*' => 'required',
            'sent_number' => 'required',
        ], $request->except('register_id'));

        foreach ($data['receiver_id'] as $item) {
            $row[$register_id] = [
                'receiver_id' => $item,
                'sent_number' => $data['sent_number'],
                'sender_id' => \Auth::user()->service->id,
                'sent_at' => now()->toDate(),
                'arrived_at' => now()->toDate(),
            ];
            $tmp[$item] = $row;
        }
        return $tmp;
    }

    /**
     * Save the sent mail for all receivers in the Out-coming register with the same sent_number
     * @param Mail $mail
     * @param Request $request
     * @return Mail
     */
    public function send(Mail $mail, Request $request): Mail
    {
        $data = $this->createReceivers($request);

        //attach mails to register with request data
        foreach ($data as $row){
            //dd($row[$request->register_id]['receiver_id']);
            // get a receiver register
            $receiverR = (new RegisterRepository())
                            ->model()::query()
                            ->where('service_id',$row[$request->register_id]['receiver_id'])
                            ->withOutGlobalScope(ServiceScope::class)
                            ->first()->id;

            $copy = $mail->duplicate($row[$request->register_id]['receiver_id']);
            $new[$receiverR] = $row[$request->register_id];
            if($mail->hasMedia('attachments')){
                foreach ($mail->getMedia('attachments') as $media)
                    $copy->attachMedia($media,'attachments');
            }

            $copy->registers()->attach($new);

            $mail->registers()->attach($row);
        }

        return $mail;
    }

    /**
     *
     * Save the record inside the receiver In-coming register
     * @param Mail $mail
     * @param Request $request
     * @return Mail
     */

    public function storeRecorded(Mail $mail, Request $request): Mail
    {
        //TODO complete the recording method

        $data = $request->validate(['register_id' => 'required',
            'record_number' => 'required',
            'reference_number' => 'required',
            'recorded_data.*' => 'required',
        ]);


        $data['recorded_at'] = now()->toDate();

        if(!$mail->registers()->exists()){
            //dd($mail->registers);
            $register = (new RegisterRepository())->find($data['register_id']);

            $data['receiver_id'] = auth()->user()->service_id;
            $mail->registers()->attach($register);
            $mail->registers()->latest()->update($data);
        }else{
            // recorded_at recorded_data record_number
            $mail->actualregister(\Auth::user()->service_id)->update($data);
        }


        return $mail;
    }


    /**
     * Save the Mail processing action
     */

    public function storeProcessing(Mail $mail, Request $request): Mail
    {

        //dd($request->all());
        $data = $request->validate([
            'processed_data.*'=>'sometimes',
            'response_needed'=>'required',
            'response_deadline'=>'nullable',
            'processed_orientations'=>'sometimes'
        ]);
        $data['processed_at'] = now()->toDate();


        //dd($data);
        $mail->actualregister(\Auth::user()->service_id)->update($data);

        return $mail;
    }
    /**
     * Send the processed mail
     */

    public function storeSendProcessing(Mail $mail, Request $request): Mail
    {


        //TODO like Send Duplicate with service_id as receiver and attached with one of his registres.
        $data = $this->createReceivers($request);
        $mail->actualregister(\Auth::user()->service_id)->update(['dispatched_at'=>now()->toDate()]);
        //TODo duplicate the mail to outcome register
        $outcome = $mail->duplicate(\Auth::user()->service_id);

        //attach mails to register with request data
        foreach ($data as $row) {

            $receiverR = (new RegisterRepository())
                ->model()::query()
                ->where('service_id',$row[$request->register_id]['receiver_id'])
                ->withOutGlobalScope(ServiceScope::class)
                ->first()->id;
            $copy = $mail->duplicate($row[$request->register_id]['receiver_id']);

            foreach ($row as $key =>$value) {
                $row[$key]['orientation_data'] = $mail->processMailInRegisters(\Auth::user()->service_id)->first()->pivot->processed_data;
                $row[$key]['orientation_text'] = $mail->processMailInRegisters(\Auth::user()->service_id)->first()->pivot->processed_orientations;
            }
            $outcome->registers()->attach($row);
            $new[$receiverR] = $row[$request->register_id];
            $copy->registers()->attach($new);
        }

        if($mail->hasMedia('attachments')){
            foreach ($mail->getMedia('attachments') as $media)
                $copy->attachMedia($media,'attachments');
        }

        return $mail;
    }




}
