@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ $question->title }}</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-success">Back to all question</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a href="" title="This question is useful" class="vote-up {{Auth::guest() ? 'off' : ''}} "
                               onclick="event.preventDefault(); document.getElementById('up-vote-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form action="/questions/{{$question->id}}/vote" id="up-vote-question-{{$question->id}}" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{$question->votes_count}}</span>

                            <a href="" title="This question is not useful" class="vote-down {{Auth::guest() ? 'off' : ''}}"
                               onclick="event.preventDefault(); document.getElementById('down-vote-question-{{$question->id}}').submit();">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/questions/{{$question->id}}/vote" id="down-vote-question-{{$question->id}}" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <a href="" title="Click to mark as favorite question (click again to undo)" class="favorite mt-2
                            {{ \Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '')}}"
                               onclick="event.preventDefault(); document.getElementById('favorite-question-{{$question->id}}').submit();">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{$question->favorites_count}}</span>
                            </a>
                            <form action="/questions/{{$question->id}}/favorites" id="favorite-question-{{$question->id}}" method="POST" style="display: none">
                                @if($question->is_favorited)
                                    @method('DELETE')
                                @endif
                                @csrf
                            </form>

                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <user-info :model="{{$question}}" label="Asked"></user-info>
                                {{--<span class="text-muted">Answered {{$question->created_date}}</span>
                                <div class="media">
                                    <a href="{{$question->user->url}}" class="pr-2">
                                        <img src="{{$question->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @include('answers._index', [
   'answers' => $question->answers,
   'answersCount' => $question->answers_count
   ])

    @include('answers._create')
@endsection
