<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index">CMS Admin</a>
    </div>
    
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index">Home Page</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> John Smith <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            
            <!-- Sites Dropdown -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#sites_dropdown" aria-expanded="false">
                    <i class="fa fa-fw fa-arrows-v"></i> Sites <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="sites_dropdown" class="collapse">
                    <li>
                        <a href="./sites.php">View Sites</a>
                    </li>
                    <li>
                        <a href="sites.php?source=add_site">Add Site</a>
                    </li>
                </ul>
            </li>

            <!-- Posts Dropdown -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown" aria-expanded="false">
                    <i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">View Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Add Post</a>
                    </li>
                </ul>
            </li>

            <!-- Things Dropdown -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#things_dropdown" aria-expanded="false">
                    <i class="fa fa-fw fa-arrows-v"></i> Things <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="things_dropdown" class="collapse">
                    <li>
                        <a href="./things.php">View Things</a>
                    </li>
                    <li>
                        <a href="things.php?source=add_things">Add Things</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
            </li>
            <li>
                <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Comments</a>
            </li>
            
            <!-- Users Dropdown -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown" aria-expanded="false">
                    <i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="#">View Users</a>
                    </li>
                    <li>
                        <a href="#">Add User</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
