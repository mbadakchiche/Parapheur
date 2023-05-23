
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/users.profile')</h1>
                </div>  
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{(!empty($etab))?$etab->getMedia('thumbnail')->first()->getUrl():config('app.logo')}}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
                            <p class="text-muted text-center">Software Engineer</p>
                          
                        </div>

                    </div>


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('models/users.aboutme')</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> {{auth()->user()->service->$name}}</strong>
                           
                            <hr>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">@lang('models/users.settings')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                 <div class="active tab-pane" id="settings">
                                    {!! Form::model($user, ['route' => ['profile.store', $user->id], 'method' => 'patch']) !!}

                                        @include('profile.partials.fields')
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('crud.save')</button>
                                            </div>
                                        </div>
                                {!! Form::close() !!}                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

