
<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <img src="{{str_replace('_normal', '', session("fetched_users.$screen_name.person")->profile_image_url_https)}}" class="col-md-12" alt="profile" class="img-rounded">
        </div>
        <div class="col-md-9">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>user id</th>
                <td>{{session("fetched_users.$screen_name.person")->id_str}}</td>
              </tr>
              <tr>
                <th>username</th>
                <td>{{session("fetched_users.$screen_name.person")->screen_name}}</td>
              </tr>
              <tr>
                <th>description</th>
                <td>{{session("fetched_users.$screen_name.person")->description}}</td>
              </tr>
              <tr>
                <th>followers</th>
                <td>{{session("fetched_users.$screen_name.person")->followers_count}}</td>
              </tr>
              <tr>
                <th>followings</th>
                <td>{{session("fetched_users.$screen_name.person")->friends_count}}</td>
              </tr>
              <tr>
                <th>registered at</th>
                <td>{{session("fetched_users.$screen_name.person")->created_at}}</td>
              </tr>
              <tr>
                <th>tweets</th>
                <td><a href="{{route('web.tweets', ['screen_name' => $screen_name])}}">show</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>