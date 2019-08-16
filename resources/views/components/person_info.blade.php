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
                  <td colspan="3">{{$person->id_str}}</td>
                </tr>
                <tr>
                  <th>username</th>
                  <td colspan="3">{{$person->screen_name}}</td>
                </tr>
                <tr>
                  <th>description</th>
                  <td colspan="3">{{$person->description}}</td>
                </tr>
                <tr>
                  <th>followers</th>
                  <td colspan="3">{{$person->followers_count}} <a href="{{route('web.followers', ['person' => $person])}}">(see list)</a></td>
                </tr>
                <tr>
                  <th>followings</th>
                  <td colspan="3">{{$person->friends_count}} <a href="{{route('web.followings', ['person' => $person])}}">(see list)</a></td>
                </tr>
                <tr>
                  <th>tweets</th>
                  <td colspan="3">{{$person->tweets->count()}} <a href="{{route('web.tweets', ['person' => $person])}}">(see list)</a></td>
                </tr>
                <tr>
                  <th>registered at</th>
                  <td>{{$person->registered_at_str}}</td>
                  <th>last update</th>
                  <td>{{$person->modified_at_human_str}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>