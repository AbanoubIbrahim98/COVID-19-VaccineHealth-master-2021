
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">User Profile Information</div>
        </div>
        <div class="bootstrap-admin-panel-content">

            <table class="table table-striped table-bordered" id="example2">
                <thead>
                <tr>
                    <th> Info</th>
                    <th> Details </th>

                </tr>
                </thead>
                <tbody>
                <tr><td><b>Name</b></td><td>{{$user->firstname." ".$user->lastname}}</td></tr>
                <tr><td><b>Username</b></td><td>{{$user->username}}</td></tr>
                <tr><td><b>Phone Number</b></td><td>{{$user->phone}}</td></tr>
                <tr><td><b>Email Address</b></td><td>{{$user->email}}</td></tr>
                <tr><td><b>Role</b></td><td>{{$user->role_id}}</td></tr>
                <tr><td><b>Last Login:</b></td><td>{{date("M, j Y H:i:s",strtotime($user->logs()->orderBy("created_at","desc")->first()->created_at))}} Hrs</td></tr>
                <tr><td><b>Last Updated:</b></td><td>{{date("M, j Y H:i:s",strtotime($user->orderBy("updated_at","desc")->first()->updated_at))}} Hrs</td></tr>

                <tr></tr>
                </tbody>
            </table>

        </div>
    </div>
</div>