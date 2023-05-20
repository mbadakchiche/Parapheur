


<div class="row">
    <div class="col-md-4">
        <div class="card card-widget widget-user shadow">
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">@lang('models/mails.arrived')</h3>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2"
                     src="{{!empty(Auth::user()->service->getMedia('thumbnail')->first())
                                ?Auth::user()->service->getMedia('thumbnail')->first()->getUrl()
                                :config('app.logo') }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$countArrived}}</h5>
                            <span class="description-text">@lang('models/mails.arrived')</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-widget widget-user shadow">
            <div class="widget-user-header bg-blue">
                <h3 class="widget-user-username">@lang('models/mails.needprocess')</h3>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2"
                     src="{{!empty(Auth::user()->service->getMedia('thumbnail')->first())
                                ?Auth::user()->service->getMedia('thumbnail')->first()->getUrl()
                                :config('app.logo') }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$countNeedProcess}}</h5>
                            <span class="description-text">@lang('models/mails.needprocess')</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-widget widget-user shadow">
            <div class="widget-user-header bg-blue">
                <h3 class="widget-user-username">@lang('models/mails.needdispatch')</h3>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2"
                     src="{{!empty(Auth::user()->service->getMedia('thumbnail')->first())
                                ?Auth::user()->service->getMedia('thumbnail')->first()->getUrl()
                                :config('app.logo') }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$countNeedDispatch}}</h5>
                            <span class="description-text">@lang('models/mails.needdispatch')</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
{{--

<div class="row">
    <div class="offset-1 col-md-5">
        <div class="card card-widget widget-user shadow">
            <div class="widget-user-header bg-danger">
                <h3 class="widget-user-username">@lang('models/mails.income')</h3>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2"
                     src="{{Auth::user()->service->getMedia('thumbnail')->first()->getUrl() }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row">
                    @foreach($countRecorded as $register)
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{$register->mails_count}}</h5>
                                <span class="description-text">{{$register->category}} {{$register->type}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-widget widget-user shadow">
            <div class="widget-user-header bg-warning">
                <h3 class="widget-user-username">@lang('models/mails.outcome')</h3>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2"
                     src="{{Auth::user()->service->getMedia('thumbnail')->first()->getUrl() }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row">
                    @foreach($countOutcome as $register)
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{$register->mails_count}}</h5>
                                <span class="description-text">{{$register->category}} {{$register->type}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
--}}
