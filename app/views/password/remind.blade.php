{{HTML::style("css/bootstrap.min.css") }}
<div class="col-sm-4 col-sm-offset-3" style="margin-top: 200px">
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissable" style="padding: 5px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>{{ Session::get('error') }}!</strong>
</div>
@endif
@if(Session::has('status'))
<div class="alert alert-success alert-dismissable" style="padding: 5px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>{{ Session::get('status') }}!</strong>
</div>
@endif

<form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form-horizontal">

  <div class="form-group">
     Email Address<br>
    <input type="email" name="email" class="form-control transparent-input" placeholder="Email" required />
  </div>
  <div class="form-group">
      <span class="help-block">Check your email after submission</span>
    <input type="submit" value="Send Reminder" class="btn btn-primary btn-sm">
  </div>
</form>
</div>