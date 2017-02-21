<div class="media media-v2">
    <a class="pull-left" href="#">
        <img class="media-object rounded-x" src="{{ userImageSmall($jobAnswer->user) }}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">
            <strong><a href="#">{{ $jobAnswer->user->first_name }}</a></strong>
            <small>{{ $jobAnswer->created_at->diffForHumans() }}</small>
        </h4>
        <p>{{ $jobAnswer->content }}</p>
    </div>
</div>