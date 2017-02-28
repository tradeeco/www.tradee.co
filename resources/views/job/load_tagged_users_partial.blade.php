<div class="table-search-v2">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>User Info</th>
                <th>Status</th>
                <th>Action</th>
                @if ($tag < 2)
                    <th></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($taggedUsers as $taUser)
                <?php $user = $taUser->user ?>
                @include('job/user_list_partial', ['user' => $taUser->tagUser, 'tagUser' => $taUser, 'tag' => $tag])
            @endforeach
            </tbody>
        </table>
    </div>
</div>