<tr>
    <td>
        <a href="{{ URL::route('users.profile', $user->slug) }}">
            <img class="rounded-x" src="{{ userImageSmall($user) }}" alt="" data-user_tag="{{$jobUser->id}}">
            <span class="text-center">{{ $user->first_name }}</span>
        </a>
    </td>
    <td>
        <h3 class="color-main profile">Reviews:
            <ul class="list-inline star-vote no-margin">
                <li><i class="color-main fa fa-star no-margin"></i></li>
                <li><i class="color-main fa fa-star no-margin"></i></li>
                <li><i class="color-main fa fa-star no-margin"></i></li>
                <li><i class="color-main fa fa-star-half-o no-margin"></i></li>
                <li><i class="color-main fa fa-star-o no-margin"></i></li>
            </ul>
        </h3>
        <h3 class="color-main">Registered: {{ date('F d, Y', strtotime($user->created_at)) }}</h3>
        {{--Carbon\Carbon::parse($job->created_at)->format('d-m-Y i')--}}
    </td>
    @if ($tag < 3)
    <td>
        @if ($tag == 1)
            <a href="#" class="btn btn-primary rounded text-uppercase white-color" id="express_shortlist">SHORTLIST</a>
        @elseif ($tag == 2)
            <a href="#" class="btn btn-primary rounded text-uppercase white-color" id="express_select">SELECTED</a>
        @endif
    </td>
    @endif
    <td>
        <a href="#" class="color-main" id="{{ getTaggedRemoveButtonId($tag) }}">Delete</a>
    </td>
</tr>