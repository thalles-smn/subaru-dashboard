@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ route('posts.create')  }}" class="btn btn-success">Inserir Post</a>
                        <br>
                        <br>
                        <table class="table table-condensed table-hover">
                            <tr>
                                <th width="10%">Id</th>
                                <th width="35%">Titulo</th>
                                <th width="35%">Ação</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id  }}</td>
                                    <td>{{ $post->title  }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('posts.edit',['id'=>$post->id]) }}">Editar</a>
                                        <a class="btn btn-danger" href="{{ route('posts.destroy',['id'=>$post->id]) }}">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {!!  $posts->render()  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
