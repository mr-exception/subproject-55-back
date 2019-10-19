{{-- most mentioned users --}}
@php
  $mms = [];
  foreach(session("fetched_users.$screen_name.tweets") as $tweet){
    $scores = App\Drivers\NLP::getScores($tweet->full_text);
    foreach($scores as $cid => $score){
      // if($score < -999999999)
      //   continue;
      if(isset($mms[$cid])){
        $mms[$cid] += $score;
      }else{
        $mms[$cid] = $score;
      }
    }
  }
  arsort($mms);
@endphp
<div class="col-md-12">
  <div class="card">
    <div class="card-header">Most Mentioned Subjects</div>
    <div class="card-body">
      <p style="text-align: justify;">The list of subjects user used to speak about. means the main toughts and personality of user in social media. scores are symbolic and doesn't mean anything (mathematically).<p>
      <table class="table table-striped">
        <tbody>
          <tr><th>subject</th><th>score</th></tr>
          @php
            $count = 0;
          @endphp
          @foreach($mms as $cid => $score)
            @php
              $count++;
              if($count > 5)
                break;
            @endphp
            <tr>
              <td>{{App\Models\Subject::find($cid)->title}}</td>
              <td>{{intval(intval(($score + 100000) / 100))/100}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>