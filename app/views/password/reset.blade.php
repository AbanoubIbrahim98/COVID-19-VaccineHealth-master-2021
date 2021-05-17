{{HTML::style("css/bootstrap.min.css") }}
@if (Session::has('error'))
{{ trans(Session::get('reason')) }}
@endif
<div class="col-sm-4 col-sm-offset-3" style="margin-top: 200px">
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissable" style="padding: 5px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ Session::get('error') }}!</strong>
    </div>
    @endif
  <form action="{{ action('RemindersController@postReset') }}" method="POST">
      <div class="form-group">
          Email Address<br>
          <input type="hidden" name="token" value="{{ $token }}" class="form-control">
          <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
              New Password<br>
              <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
                  Repeat Password<br>

                  <input type="password" name="password_confirmation" class="form-control">
          </div>
          <div class="form-group">
              <input type="submit" value="Reset Password" class="btn btn-primary btn-sm">
          </div>
  </form>