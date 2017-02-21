<div class="media media-v2 margin-bottom-20">
    <a class="pull-left" href="#">
        <img class="media-object rounded-x" src="{{ userImageSmall($jobQuestion->user) }}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">
            <strong><a href="#">{{ $jobQuestion->user->first_name }}</a></strong>
            <small>{{ $jobQuestion->created_at->diffForHumans() }}</small>
        </h4>
        <p>{{ $jobQuestion->content }}</p>
        {{--<ul class="list-inline results-list pull-left">--}}
        {{--<li><a href="#">5 Likes</a></li>--}}
        {{--<li><a href="#">1 Share</a></li>--}}
        {{--</ul>--}}
        <ul class="list-inline pull-right">
            <li><a href="javascript:void(0)" id="reply_question"><i class="expand-list rounded-x fa fa-reply"></i></a></li>
            {{--<li><a href="#"><i class="expand-list rounded-x fa fa-heart"></i></a></li>--}}
            {{--<li><a href="#"><i class="expand-list rounded-x fa fa-retweet"></i></a></li>--}}
        </ul>

        <div class="clearfix"></div>
        <div class="row">
            {!! Form::open(['url' => route('job_questions.answers.store', $jobQuestion->id), 'class' => 'answer-form fade in', 'id' => 'answer_form', 'data-question_id' => $jobQuestion->id]) !!}
            <div class="col-md-5">
                {{ Form::text('content', old('content'), ['class' => 'form-control rounded', 'placeholder' => 'Answer']) }}
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary rounded">Submit</button>
                <a href="javascript:void(0)" class="btn btn-default rounded" id="reply_cancel">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="job-answers">
            @foreach ($jobQuestion->jobAnswers as $jobAnswer)
                @include('job/question_answer/answer_partial', ['jobAnswer' => $jobAnswer])
            @endforeach
        </div>
    </div>
</div><!--/end media media v2-->