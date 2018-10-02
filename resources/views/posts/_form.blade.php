<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Titulo', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('title', null , ['class'=>'form-control']) !!}

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('text') ? ' has-error' : '' }}">
    {!! Form::label('text', 'Conteudo', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('text', null , ['class'=>'form-control']) !!}

        @if ($errors->has('text'))
            <span class="help-block">
                <strong>{{ $errors->first('text') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
    {!! Form::label('photo', 'Foto', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::file('photo'); !!}

        @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
    </div>
</div>

