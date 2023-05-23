 <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($user, ['route' => ['profile.store', $user->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
 </div>

