<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Repositories\MailRepository;
use Illuminate\Http\Request;

class searchableMailController extends Controller
{
    /** @var MailRepository $mailRepository*/
    private MailRepository $mailRepository;

    public function __construct(MailRepository $mailRepo)
    {
        $this->mailRepository = $mailRepo;
    }

    public function index(Request $request)
    {
        $this->authorize('ViewAny', arguments: Mail::class);
        return view('mails.details.arrived');
    }

    public function income(Request $request)
    {
        $this->authorize('ViewAny', arguments: Mail::class);
        return view('mails.details.income');
    }

    public function outcome(Request $request)
    {
        $this->authorize('ViewAny', arguments: Mail::class);
        return view('mails.details.outcome');
    }
    public function needprocess(Request $request)
    {
        $this->authorize('ViewAny', arguments: Mail::class);
        return view('mails.details.needprocess');
    }
    public function needDispatch(Request $request)
    {
        $this->authorize('ViewAny', arguments: Mail::class);
        return view('mails.details.needdispatch');
    }
}
