@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
            <br>
                @include ('threads.reply')
            @endforeach
        </div>
    </div>

    @if (auth()->check())
    <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ $thread->path(). '/replies' }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        <br>
                        <button type="submit" class="btn btn-default">Post</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <br>
        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion</p>
    @endif

</div>
@endsection
