{{-- most replied users --}}
@php
  $mru = [];
  foreach(session("fetched_users.$screen_name.tweets") as $tweet){
    if(!$tweet->in_reply_to_screen_name)
      continue;
    if(!array_key_exists($tweet->in_reply_to_screen_name, $mru)){
      $mru[$tweet->in_reply_to_screen_name] = 0;
    }
    $mru[$tweet->in_reply_to_screen_name] += 1;
  }
  arsort($mru);
@endphp
<div class="col-md-12">
  <div class="card">
    <div class="card-header">Most Replied Users</div>
    <div class="card-body">
      <p style="text-align: justify;">The list of users targeted. That is, the more the user has been informed, the higher this list. This means that the target user is in addition to being tracked in the tracklist. That is, its activities are monitored and monitored.<p>
      <table class="table table-striped">
        <tbody>
          <tr><th>username</th><th>count</th></tr>
          @foreach(array_slice($mru, 0, 10) as $screen_name => $count)
            <tr>
              <td>{{$screen_name}}</td>
              <td>{{$count}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>