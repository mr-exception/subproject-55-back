
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
<div class="row justify-content-center" style="margin-top: 15px;">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <img src="{{$person->profile_image_url_https_original}}" class="col-md-12" alt="profile" class="img-rounded">
          </div>
          <div class="col-md-9">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th>user id</th>
                  <td>{{$person->id_str}}</td>
                </tr>
                <tr>
                  <th>username</th>
                  <td>{{$person->screen_name}}</td>
                </tr>
                <tr>
                  <th>description</th>
                  <td>{{$person->description}}</td>
                </tr>
                <tr>
                  <th>followers</th>
                  <td>{{$person->followers_count}} <a href="#">(see list)</a></td>
                </tr>
                <tr>
                  <th>followings</th>
                  <td>{{$person->friends_count}} <a href="#">(see list)</a></td>
                </tr>
                <tr>
                  <th>tweets</th>
                  <td>{{$person->tweets->count()}} <a href="#">(see list)</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>