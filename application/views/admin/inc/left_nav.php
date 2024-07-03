<div class="dsm-navigation">
    <div class="dsm-nav-inner">
        <div class="dsmn-logo">
            <a href="<?=MAINSITE_Admin?>"><img src="<?=_admin_files_?>img/logo.png" class="w-100" alt="logo"></a>
        </div>
        <div class="dsmn-menu">
            <div class="dsmn-m-li">

                <ul class="nav nav-pills mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="<?=MAINSITE_Admin?>"><span><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg> Dashboard</span></a>
                    </li>
                    <?
          if(!empty($left_menu_module_list))
    {
        echo $left_menu_module_list;
          }
  ?>

                </ul>
            </div>
        </div>
        <div class="dsmn-logout">
            <a href="<?=MAINSITE_Admin.'wam/logout'?>" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>
</div>
<div class="dsm-content">
    <div class="dsm-header">
        <div class="dsm-head-inner">
            <div class="dsm-toggle">
                <span class="toggle-btn"><i class="fa-solid fa-bars"></i></span>
            </div>
            <div class="dsm-user-menu">
                <div class="dsm-notification">
                    <span class="dhm-head-notified"><i class="fa-solid fa-bell"></i><span
                            class="noti-dig">04</span></span>
                    <div class="dhm-hn-con">
                        <div class="dhm-hnc-inner">
                            <ul>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="dhm-hl">
                                            <div class="dhm-hl-l">
                                                <img src="<?=_admin_files_?>img/dummy.jpg" alt="notification-image">
                                            </div>
                                            <div class="dhm-hl-r">
                                                <p>Dashpro Company, Placed 2000.00 RS Order!</p>
                                                <span class="not-badge">New Order</span> <span
                                                    class="not-time">Apr 10, 2024 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div class="dhm-hr">
                                            <div class="dhm-delete">
                                                <span class="not-delete"><i
                                                        class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dsm-user-box">
                    <span class="user-profile"><img src="<?=_admin_files_?>img/user.jpg" alt="user-profiles"></span>
                    <div class="dsm-ub-con">
                        <div class="dsm-ubc-inner">
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-boxes-stacked"></i> Dashboard</a></li>
                                <li><a href="#"><i class="fa-solid fa-user-pen"></i> Edit Profile</a></li>
                                <li><a href="<?=MAINSITE_Admin.'wam/logout'?>"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
