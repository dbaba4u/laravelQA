<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title mt-3">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                <form action="{{route('questions.answers.store', $question->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea id="" name="body" rows="7" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" ></textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback"><span>{{$errors->first('body')}}</span></div>
                        @endif
{{--                        @if($errors->has('body'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    <strong>{{$errors->first('body')}}</strong>--}}
{{--                                </div>--}}
{{--                        @endif--}}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
