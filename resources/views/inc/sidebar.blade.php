<div class="bg-dark" id="sidebar">
    <div class="sidebar-profile">
        <div class="sidebar-profile-info" style="text-align:center">
                <h4><b>Administrator</b></h4>
                <p>{{Auth::guard('admin')->user()->email}}</p>
        </div>
    </div>
    <ul id="accordion1" class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link well separator">MAIN NAVIGATION</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin">
                <span class="glyphicon glyphicon-dashboard"></span> Dashboard 
                <span class="glyphicon glyphicon-triangle-left active-span"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/manage_employers">
                <span class="glyphicon glyphicon-user"></span> Manage Employers
                <span class="glyphicon glyphicon-triangle-left active-span"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/manage_posts">
                <span class="glyphicon glyphicon-comment"></span> Manage Posts
                <span class="glyphicon glyphicon-triangle-left active-span"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link separator"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.account.info')}}">
                <span class="fa fa-cogs"></span> Account Settings
                <span class="glyphicon glyphicon-triangle-left active-span"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link separator"></a>
        </li>
    </ul>
</div>