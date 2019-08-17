<div class="row justify-content-center" style="margin-top: 15px;">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          @if($tweet->lang == 'fa')
            <div class="col-md-12" style="direction: rtl; text-align: right;">
              {{$tweet->text}}
            </div>
          @else
            <div class="col-md-12">
              {{$tweet->text}}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>