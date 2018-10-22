            <!--Header Wrap Start-->
            <header class="gt_hdr2_wrap">
                <div class="gt_top2_wrap default_width">
                    <div class="container">

                        <div class="gt_hdr_2_ui_element">
                            <ul>
                                <?php if (isset($_SESSION['loggedUserName'])) { ?>
                                    <li><a data-target="#gt-login" href="remote.html" data-toggle="modal" href="#" style="color: #29B6F6;"><?php echo $_SESSION['loggedUserName']; ?></a></li>
                                    <?php } ?>
                                <li><a href="UserProfile.php">Student profile</a></li>
                                <li><i class="icon-lock"></i><a href="login-register.php">Login &#38; Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="gt_menu_bg default_width">
                    <div class="container">
                        <!--Logo Wrap Start-->
                        <div class="gt_logo gt_logo_padding">
                            <div  style=" font-family: Square721 Ex BT;">
                                <p style="font-family: 'Montserrat', sans-serif;font-size: 45px;padding-top: 10px;color: #333333">SAMINCO</p>
                                <p style="font-family: 'Montserrat', sans-serif;margin-top:  -5px;margin-left: 2px;color: #999999;font-size: 15px">Smart Class</p>
                            </div>
                        </div>
                        <!--Logo Wrap End-->
                        <!--Navigation Wrap Start-->
                        <nav class="gt_navigation2">
                            <button class="gt_mobile_menu">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <ul>
                                <li class="active"><a href="index-02.php">Home</a>
                                </li>
                                <li><a href="aboutUs.php">About Us</a></li>
                                <li><a href="ArticleGridView.php">Articles</a>

                                </li>
                                <li><a href="">Courses</a>
                                    <ul>
                                        <li><a href="">Advanced Level</a></li>
                                        <li><a href="">Ordinary Level</a></li>
                                        <li><a href="">ED-Excel</a></li>
                                        <li><a href="">Cambridge A/level</a></li>
                                        <li><a href="">Cambridge O/level</a></li>

                                    </ul>
                                </li>
                                <li><a href="PaperGridView.php">Papers</a>

                                </li>
                                <li><a href="TuteGridView.php">Tutes</a>

                                </li>

                                <li><a href="ContactUs.php">Contact Us</a></li>
                            </ul>
                        </nav>
                        <!--Navigation Wrap End-->
                    </div>
                </div>
            </header>
            <!--Header Wrap End-->