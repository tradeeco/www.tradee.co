<div class="table-search-v2">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>User Info</th>
                <th>Status</th>
                <th>Action</th>
                @if ($tag < 3)
                    <th></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($taggedJobUsers as $taJob)
                <?php $user = $taJob->user ?>
                @include('job/user_list_partial', ['jobUser' => $taJob, 'user' => $user, 'tag' => $tag])
            @endforeach
            </tbody>
        </table>
    </div>
</div>