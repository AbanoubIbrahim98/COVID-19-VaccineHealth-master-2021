<div class="row">
<div class="box ">
    <div class="box-header">
        <h3 class="box-title">Update Your Information </h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form role="form" id="profileEditor" method="post" action="{{url("user/edit/{$user->id}")}}">
        <div class="box-body">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="middlename">User Name</label>
                <input type="text" class="form-control" id="middlename" name="username" value="{{ $user->username }}" placeholder="Middle Name">
            </div>


            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email Address">
            </div>
            <input type="hidden" name="role" value="{{ $user->role_id }}">

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Phone Number">
            </div>

            <div class="form-group">
                <label for="phone">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="phone">Re-enter Password</label>
                <input type="password" class="form-control" id="password" name="re_enter_password" value="" placeholder="Re-enter Password">
            </div>
        </div><!-- /.box-body -->
        <div id="output"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </form>
</div><!-- /.box -->
</div><script>
    $(document).ready(function (){
        $('#profileEditor').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#profileEditor').resetForm();
            setTimeout(function() {
                $("#output").html("");
            }, 3000);
            $("#profileInfo").load("<?php echo url("profileInfo") ?>");
            ("#profileEdit").load("<?php echo url("profileEdit") ?>");
        }
    });
</script>
