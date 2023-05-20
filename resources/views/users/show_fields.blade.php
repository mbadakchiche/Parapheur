<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('email_verified_at', __('models/users.fields.email_verified_at').':') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Remember Token Field -->
<div class="col-sm-12">
    {!! Form::label('remember_token', __('models/users.fields.remember_token').':') !!}
    <p>{{ $user->remember_token }}</p>
</div>

