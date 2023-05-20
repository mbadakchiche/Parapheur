<?php

namespace App\Providers;

use App;
use App\Models\Dossier;
use App\Models\Etablissement;
use App\Models\Register;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use jeremykenedy\LaravelRoles\Models\Role;
use View;

class ViewServiceProvider extends ServiceProvider
{
    private $nullSelected = [null => 'Select .... '];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view){
            $etab = Etablissement::first();
            $view->with('etab',$etab);
        });

        //********* Dashboard Views
        View::composer(['Home.partials.register-stats'], function ($view) {
            $countArrived = App\Models\Mail::arrived(auth()->user()->service_id)->count();
            $countNeedProcess = App\Models\Mail::needprocess(auth()->user()->service_id)->count();
            $countNeedDispatch = App\Models\Mail::needdispatch(auth()->user()->service_id)->count();

            $countRecorded = Register::withCount(['mails' => function ($query) {
                $query->income(auth()->user()->service_id);
            }])->income()->get();

            $countOutcome = Register::withCount(['mails' => function ($query) {
                $query->outcome(auth()->user()->service_id);
            }])->outcome()->get();

            $view->with('countArrived', $countArrived)
                 ->with('countNeedProcess', $countNeedProcess)
                 ->with('countNeedDispatch', $countNeedDispatch)
                 ->with('countRecorded', $countRecorded)
                 ->with('countOutcome', $countOutcome);
        });
        //********* Users Views
        View::composer(['users.fields'], function ($view) {
            $rolesItems = $this->nullSelected + Role::all()->pluck('description', 'id')->toArray();
            $ServiceItems = $this->nullSelected + Service::all()->pluck('name_' . App::getLocale(), 'id')->toArray();
            $view->with('rolesItems', $rolesItems)
                ->with('ServiceItems', $ServiceItems);
        });

        //********* registers Views
        View::composer(['registers.fields'], function ($view) {
            $ServiceItems = $this->nullSelected+Service::all()->pluck('name_'.App::getLocale(), 'id')->toArray();
            $typeItems = (new Register())->types[App::getLocale()];
            $categoryItems = (new Register())->categories[App::getLocale()];
            $view->with('ServiceItems', $ServiceItems)
                 ->with('typeItems', $typeItems)
                 ->with('categoryItems', $categoryItems);
        });

        //********* Circulation send form fields Views
        View::composer(['circulation.send.fields'], function ($view) {
            $registersItems = \Auth::user()->service->registers()->where('category',2)->pluck('label_'.App::getLocale(), 'id')->toArray();
            $ServiceItems = Service::where('id','!=', \Auth::user()->service->id)
                                        ->whereHas('registers', function ($query){
                                            return $query->withOutGlobalScope(App\Models\Scopes\ServiceScope::class);
                                        })
                                        ->get()
                                        ->pluck('name_'.App::getLocale(), 'id')->toArray();
            $view->with('ServiceItems', $ServiceItems)
                 ->with('registersItems', $registersItems);
        });

        //********* Circulation attach form fields Views
        View::composer(['circulation.attach.fields'], function ($view) {

            $DossiersItems = auth()->user()->dossiers()->pluck('label_'.App::getLocale(), 'id')->toArray();

            $view->with('DossiersItems', $DossiersItems);
        });

        //********* Circulation record form fields Views
        View::composer(['circulation.record.fields'], function ($view) {
            $registersItems = \Auth::user()->service->registers()->where('category',1)->pluck('label_'.App::getLocale(), 'id')->toArray();
            $ServiceItems = Service::where('id','!=', \Auth::user()->service->id)->get()->pluck('name_'.App::getLocale(), 'id')->toArray();
            $view->with('ServiceItems', $ServiceItems)
                 ->with('registersItems', $registersItems);
        });
        //********* Circulation processing form fields Views
        View::composer(['circulation.process.fields'], function ($view) {
            $actionItems = App\Models\Action::all()->pluck('name_'.App::getLocale(), 'id')->toArray();
            $ServiceItems = Service::where('id','!=', \Auth::user()->service->id)->get()->pluck('name_'.App::getLocale(), 'id')->toArray();
            $view->with('ServiceItems', $ServiceItems)
                 ->with('actionItems', $actionItems);
        });
        //********* Circulation SendProcessing form fields Views
        View::composer(['circulation.send_process.fields'], function ($view) {
            $registersItems = \Auth::user()->service->registers()->where('category',2)->pluck('label_'.App::getLocale(), 'id')->toArray();
            $ServiceItems = Service::where('id','!=', \Auth::user()->service->id)->get()->pluck('name_'.App::getLocale(), 'id')->toArray();
            $view->with('ServiceItems', $ServiceItems)
                ->with('registersItems', $registersItems);
        });

        //********* Circulation SendProcessing form fields Views
        View::composer(['dossiers.fields'], function ($view) {
            $StatusItems = (new Dossier())->statuses[App::getLocale()];
            $usersItems = User::where('service_id',auth()->user()->service_id)->pluck('name', 'id')->toArray();
            $view->with('StatusItems',$StatusItems)
                 ->with('usersItems', $usersItems);
        });

    }
}
