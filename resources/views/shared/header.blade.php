<header class="header">
    <div class="left">
        <div class="icon toggle-side-bar">
            <i class="fas fa-bars"></i>
        </div>
    </div>
    <div class="middle">
        <img src="{{ asset('img/logo.min.svg') }}" alt="Logo">
    </div>
    <div class="right">
        <div class="icon sm-screen">
            <i class="fas fa-ellipsis-v"></i>
        </div>
        <div class="icons">
            <div class="icon profile">
                <span>{{ getAbbreviation(auth()->user()['full_name']) }}</span>
                <div class="dropdown">
                    <h3>{{ auth()->user()['name'] }}</h3>
                    <ul>
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-user"></i> My Profile</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-user"></i> Edit Profile</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-user"></i> Account Settings</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-user"></i> Support</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-user"></i> Activity</a>--}}
{{--                        </li>--}}
                        <li>
                            <a id="logout" href="{{ route('logout') }}"><i class="fas fa-user"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
{{--            <div class="icon">--}}
{{--                <i class="fas fa-bell"></i>--}}
{{--                <span class="badge bg-danger">--}}
{{--                    4--}}
{{--                </span>--}}
{{--                <div class="dropdown notifications">--}}
{{--                    <div class="head">--}}
{{--                        <h3>You have 1 unread notification <span class="badge bg-primary">View all</span></h3>--}}
{{--                    </div>--}}
{{--                    <ul>--}}
{{--                        <li>--}}
{{--                            <a href="#">--}}
{{--                                <span class="profile">EF</span>--}}
{{--                                <div>--}}
{{--                                    <h4>Congratulate <strong>Olivia James</strong> for New template start</h4>--}}
{{--                                    <h6>Oct 15 12:32pm</h6>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#">--}}
{{--                                <span class="profile">EF</span>--}}
{{--                                <div>--}}
{{--                                    <h4>Congratulate <strong>Olivia James</strong> for New template start</h4>--}}
{{--                                    <h6>Oct 15 12:32pm</h6>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#">--}}
{{--                                <span class="profile">EF</span>--}}
{{--                                <div>--}}
{{--                                    <h4>Congratulate <strong>Olivia James</strong> for New template start</h4>--}}
{{--                                    <h6>Oct 15 12:32pm</h6>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="footer">--}}
{{--                        <a href="#">View All Notifications</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</header>
