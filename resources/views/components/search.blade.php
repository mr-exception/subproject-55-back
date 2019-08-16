<div class="row justify-content-center">
  <div class="col-md-12 col-sm-12" style="text-align: center; margin-top: 25px;">
    <form action="{{route('web.search')}}" method="GET">
      <div class="input-group">
        <input type="text" value="{{$person->screen_name}}" name="screen_name" class="form-control" placeholder="twitter username (eg: reza_binzar)">
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="submite">Search!</button>
        </div>
      </div>
    </form>
  </div>
</div>