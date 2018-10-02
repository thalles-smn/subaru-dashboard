@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model( $post,['method'=>'put','class'=>'form-horizontal','files'=>true,'route'=>['posts.update', $post->_id]]) !!}

                        @include('posts._form')

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                                <a href="{{ route('posts.index')  }}" class="btn btn-warning">Voltar</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @if($photo != null)
                    <img id="photo" src="{{ $photo }}" width="100%">
                @endif
            </div>
        </div>
    </div>

    <script type="application/javascript">
        $.when( $.ready ).then(function() {
            $('#text').wysihtml5({
                toolbar: {
                    "image": false
                }
            });
        });

    </script>
@endsection
