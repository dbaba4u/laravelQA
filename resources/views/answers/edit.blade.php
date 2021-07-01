@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title mt-3">
                    <h3>Edit answer for question: <strong>{{$question->title}}</strong></h3>
                </div>
                <hr>
                <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <textarea id="" name="body" rows="7" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" >{{old('body', $answer->body)}}</textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback"><span>{{$errors->first('body')}}</span></div>
                        @endif

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
