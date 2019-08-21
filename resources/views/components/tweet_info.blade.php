<div class="row justify-content-center" style="margin-top: 15px;">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          @if($tweet->lang == 'fa')
            <div class="col-md-12" style="direction: rtl; text-align: right;">
              {{$tweet->full_text}}
            </div>
          @else
            <div class="col-md-12">
              {{$tweet->full_text}}
            </div>
          @endif
          @php
            use \App\Drivers\NLP;
            $classes = NLP::getScores($tweet->full_text);
          @endphp
          <div class="col-md-12">
            @foreach($classes as $cls=>$score)
              @php
                $subject = \App\Models\Subject::whereId($cls)->first();
              @endphp
              <span class="badge badge-secondary">{{$subject->title}}</span>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>