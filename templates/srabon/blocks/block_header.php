<div class="navbar navbar-fixed-top">
    <div class="navbar-inner top-nav">
        <div class="container-fluid">
            <div class="branding">
                <div class="logo"> <a href="index.html"><img src="img/logo.png"  alt="Logo"></a> </div>
            </div>
            <?php
            Core::app()->getTemplate()->getModulesByPosition('admin_header_top');
            ?>
            <ul class="nav pull-right">
                <li class="dropdown search-responsive"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="nav-icon magnifying_glass"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="top-search">
                            <form action="#" method="get">
                                <div class="input-prepend"> <span class="add-on"><i class="icon-search"></i></span>
                                    <input type="text" id="searchIcon">
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="lang-icons"><img src="img/flag-icons/us.png" width="16" height="11" alt="language"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="lang-icons"><img src="img/flag-icons/gb.png" width="16" height="11" alt="language"></i> English UK</a></li>
                        <li><a href="#"><i class="lang-icons"><img src="img/flag-icons/fr.png" width="16" height="11" alt="language"></i> French</a></li>
                        <li><a href="#"><i class="lang-icons"><img src="img/flag-icons/sa.png" width="16" height="11" alt="language"></i> Arabic</a></li>
                        <li><a href="#"><i class="lang-icons"><img src="img/flag-icons/it.png" width="16" height="11" alt="language"></i> Italian</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Anthony <span class="alert-noty">25</span><i class="white-icons admin_user"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-inbox"></i> Inbox <span class="alert-noty">10</span></a></li>
                        <li><a href="#"><i class="icon-envelope"></i> Notifications <span class="alert-noty">15</span></a></li>
                        <li><a href="#"><i class="icon-briefcase"></i> My Account</a></li>
                        <li><a href="#"><i class="icon-file"></i> View Profile</a></li>
                        <li><a href="#"><i class="icon-pencil"></i> Edit Profile</a></li>
                        <li><a href="#"><i class="icon-cog"></i> Account Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-off"></i><strong> Logout</strong></a></li>
                    </ul>
                </li>
            </ul>
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="nav-icon list"></i> Forms <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="form-elements.html">All Form Elements</a></li>
                            <li><a href="extendable-forms.html">Extendable Form</a></li>
                            <li><a href="form-stepy.html">Stepy Forms</a></li>
                            <li><a href="form-validation.html">Form Validation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="nav-icon cup"></i> Features<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="table-default.html">Basic Table</a></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="widgets.html">Widgets</a></li>
                            <li><a href="grid.html">Grid</a></li>
                            <li class=" divider"></li>
                            <li><a href="login.html">Login Page</a></li>
                            <li><a href="login2.html"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Another Login Page</a></li>
                            <li class=" divider"></li>
                            <li class="nav-header">UI Elements</li>
                            <li><a href="button-icons.html">Buttons &amp; Icons</a></li>
                            <li><a href="ui-elements.html">All UI Elements</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="nav-icon shuffle"></i> Others <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="table.html">Data Table</a></li>
                            <li><a href="chart.html">Chart and Graph</a></li>
                            <li><a href="file-explorer.html">File Manager</a></li>
                            <li><a href="calendar.html">Full Calendar</a></li>
                            <li><a href="colorbox.html">Colorbox</a></li>
                            <li class=" divider"></li>
                            <li class=" nav-header">More Pages</li>
                            <li><a href="inbox.html">Message Box</a></li>
                            <li><a href="content.html">Content Post</a></li>
                            <li><a href="forgot-pass.html">Forgot Password Page</a></li>
                            <li><a href="error.html"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Error Page</a></li>
                            <li><a href="another-error-page.html"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Another Error Page</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="nav-icon cog_3"></i> Themes Settings<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="nav-header">Colors</li>
                            <li class=" clearfix color-block"><span class="theme-color theme-blue" title="theme-blue"></span><span class="theme-color theme-light-blue" title="theme-light-blue"></span><span class="theme-color theme-dark" title="theme-dark"></span><span class="theme-color theme-chrome" title="theme-chrome"></span><span class="theme-color theme-chayam" title="theme-chayam"></span><span class="theme-color theme-default" title="theme-default"></span></li>
                            <li class=" divider hidden-phone hidden-tablet"></li>
                            <li class="nav-header hidden-phone hidden-tablet">Sidebar</li>
                            <li class="theme-settings clearfix hidden-phone hidden-tablet">
                                <div class="btn-group">
                                    <button id="sidebar-on" disabled="disabled" class="btn btn-success">On</button>
                                    <button id="sidebar-off" class="btn btn-inverse">Off</button>
                                </div>
                            </li>
                            <li class=" divider"></li>
                            <li class="nav-header hidden-phone hidden-tablet">Sidebar Placement</li>
                            <li class="theme-settings clearfix hidden-phone hidden-tablet">
                                <div class="btn-group">
                                    <button disabled="disabled" id="left-sidebar" class="btn btn-inverse">Left</button>
                                    <button id="right-sidebar" class="btn btn-info">Right</button>
                                </div>
                            </li>
                            <li class="nav-header">Layout</li>

                            <li><a href="../fixed-layout/index.html">Fixed Layout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

