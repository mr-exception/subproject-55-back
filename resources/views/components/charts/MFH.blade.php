{{-- most frequest hashtags --}}
@php
  $mfu = [];
  foreach(session("fetched_users.$screen_name.tweets") as $tweet){
    foreach($tweet->entities->hashtags as $hashtag){
      if(!$hashtag->text)
        continue;
      if(!array_key_exists($hashtag->text, $mfu)){
        $mfu[$hashtag->text] = 0;
      }
      $mfu[$hashtag->text] += 1;
    }
  }
  arsort($mfu);
@endphp
<div class="col-md-12">
  <div class="card">
    <div class="card-header">Most Frequest Hashtags</div>
    <div class="card-body">
      <p style="text-align: justify;">Hashtags that the user has used. It can determine the user orientation of what concerns in cyberspace and what political, social and cultural groups it is looking for. This list of ten most-used hashtags can be viewed in up to 3 recent tweets.<p>
      <table class="table table-striped">
        <tbody>
          <tr><th>hashtag</th><th>count</th></tr>
          @foreach(array_slice($mfu, 0, 10) as $screen_name => $count)
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