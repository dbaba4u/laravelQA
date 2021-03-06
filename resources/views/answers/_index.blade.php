<div class="row justify-content-center v-cloak">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title mt-3">
                    <h2>{{$answersCount ." " . \Illuminate\Support\Str::plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($answers as $answer)
                    <div class="lead mb-2">Answered by {{$answer->user->name}}</div>
                    <answer :answer="{{$answer}}" inline-template>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a href="" title="This answer is useful" class="vote-up {{Auth::guest() ? 'off' : ''}} "
                                   onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{$answer->id}}').submit();"
                                >
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form action="/answers/{{$answer->id}}/vote" id="up-vote-answer-{{$answer->id}}" method="POST" style="display: none">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>
                                <span class="votes-count">{{$answer->votes_count}}</span>

                                <a href="" title="This answer is not useful" class="vote-down {{Auth::guest() ? 'off' : ''}}"
                                   onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{$answer->id}}').submit();">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form action="/answers/{{$answer->id}}/vote" id="down-vote-answer-{{$answer->id}}" method="POST" style="display: none">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                @can('accept', $answer)
                                    <a href="" title="Mark this answer as best answer" class="mt-2 {{$answer->status}}"
                                       onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                    <form action="{{route('answers.accept',$answer->id)}}" id="accept-answer-{{$answer->id}}" method="POST" style="display: none">
                                        @csrf

                                    </form>
                                @else
                                    @if($answer->is_best)
                                        <a href="" title="The question owner accepted this answer as best answer" class="mt-2 {{$answer->status}}">
                                            <i class="fas fa-check fa-2x"></i>
                                        </a>
                                    @endif
                                @endcan
                            </div>
                            <div class="media-body">
                                <form v-if="editing" @submit.prevent="update">
                                    <div class="form-group">
                                        <textarea v-model="body" rows="10" class="form-control" required></textarea>
                                    </div>
                                    <button class="btn btn-light btn-sm" :disabled="isInvalid">Update</button>
                                    <button class="btn btn-secondary btn-sm" @click="cancel" type="button">Cancel</button>
                                </form>
                                <div v-else>
                                    <div v-html="bodyHtml"></div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="ml-auto btn-group">
                                                @can ('update', $answer)
                                                    <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                                                @endcan
                                                @can ('delete', $answer)
                                                    <form action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="q-delete btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                @endcan

                                            </div>
                                        </div>
                                        <div class="col-4"></div>
                                        <div class="col-4">
                                            <user-info :model="{{$answer}}" label="Answered"></user-info>
                                            {{--                                    <span class="text-muted">Answered {{$answer->created_date}}</span>--}}
                                            {{--                                    <div class="media">--}}
                                            {{--                                        <a href="{{$answer->user->url}}" class="pr-2">--}}
                                            {{--                                            <img src="{{$answer->user->avatar}}" alt="">--}}
                                            {{--                                        </a>--}}
                                            {{--                                        <div class="media-body">--}}
                                            {{--                                            <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>--}}
                                            {{--                                        </div>--}}
                                            {{--                                    </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </answer>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
