{{-- tweets and likes and retweets per day --}}
<div class="row">
  <div class="col-md-12">
    <div style="width:100%;">
      <canvas id="tweets-retweets-likes"></canvas>
    </div>
  </div>
</div>
<script>
  @php
    use Carbon\Carbon;
    $days = [];
    foreach(session("fetched_users.$screen_name.tweets") as $tweet){
      if(substr($tweet->full_text, 0, 2) == 'RT')
        continue;
      $time = (new Carbon($tweet->created_at))->format('Y/m/d');
      if(!array_key_exists($time, $days)){
        $days[$time] = [
          'tweets' => 0,
          'likes' => 0,
          'retweets' => 0,
        ];
      }
      $days[$time]['tweets'] += 1;
      $days[$time]['likes'] += $tweet->favorite_count;
      $days[$time]['retweets'] += $tweet->retweet_count;
    }
  @endphp
  var config = {
    type: 'line',
    data: {
      labels: [
        @foreach($days as $dt => $day)
          '{{$dt}}',
        @endforeach
      ],
      datasets: [{
        label: 'Tweets',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        data: [
          @foreach($days as $day)
            {{$day['tweets']}},
          @endforeach
        ],
        fill: false,
      },
      {
        label: 'Likes',
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        data: [
          @foreach($days as $day)
            {{$day['likes']}},
          @endforeach
        ],
        fill: false,
      },
      {
        label: 'Retweets',
        backgroundColor: window.chartColors.green,
        borderColor: window.chartColors.green,
        data: [
          @foreach($days as $day)
            {{$day['retweets']}},
          @endforeach
        ],
        fill: false,
      }]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: 'Tweets & Likes & Retweets'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Month'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value'
          }
        }]
      }
    }
  };

  window.onload = function() {
    var ctx = document.getElementById('tweets-retweets-likes').getContext('2d');
    window.myLine = new Chart(ctx, config);
  };
</script>