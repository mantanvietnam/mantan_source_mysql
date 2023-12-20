<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
    // debug($listData);
    //debug($data);
?>
    <main>
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <a href="/"><img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-team">
            <div class="container">
                <div class="title-section">
                    <h1><?php echo $data['title'] ?></h1>
                    <div class="title-divide-section"></div>
                </div>

                <div class="team-content">
                    <?php echo $data['content'] ?>
                    
                </div>

                <!-- <div class="team-box">
                    1. Head of WARM team, <br>
                    2. WARM Project Officer (WARM PO) and <br>
                    3. Provincial project officers (PPO),  
                </div>

                <div class="team-title-content2">
                    <strong>Project consultant consortium of AETS and MKE are supporting AFD Vietnam in successfully implementing the WARM facility.</strong>
                </div>

                <div class="row row-content2">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 content2-col">
                        <div class="content2-col-inner content2-col-item-left">
                            <strong>WARM lead consultant is <a href="https://www.aets-consultants.com/">Application Européenne de Technologies et de Services (AETS)</a></strong>, an international and multidisciplinary consulting firm with its headquarters in France and 8 offices across 3 continents, specializing in the implementation of public policies and development cooperation. AETS offers sustainable solutions aimed at improving living conditions in Europe as well as in emerging and developing countries. 
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 content2-col">
                        <div class="content2-col-inner content2-col-item-right">
                            <strong>WARM local consultant is</strong> <strong><a href="https://www.mekongeconomics.com/our-services">Mekong Economics Ltd</a></strong> <strong>(MKE)</strong> with its headquarters in Hanoi. MKE has more than 15 years experience in institutional and capacity building, economic research, impact investing advisory, baselines, impact evaluation and M&E, training and project management in Vietnam and the Mekong region.
                        </div> 
                    </div>
                </div> -->
            </div>
        </section>

        <!-- <section id="section-team-background">
            <div class="team-background-inner">
                <div class="team-background">
                    <img src="<?php echo $urlThemeActive;?>/asset/img/teambackground.png" alt="">
                </div>
                <div class="team-overlay"></div>
                <div class="container">
                    <div class="team-background-content">
                        The consortium has deployed a team of highly experienced experts for the project, including 
                        <br>
                        <strong>1. Head of WARM team,</strong> <br>
                        <strong>2.	WARM Project Officer (WARM PO) and provincial project officers (PPO), we have a consultant consortium to help in</strong> <br>
                        <strong>3.	WARM Facility’s Coordination (WARM FC) and</strong> <br>
                        <strong>4.	WARM Communications Officer (WARM CO).</strong><br>
                        <br>
                        The team works together flexibly and supportively to deliver effective and efficient solutions to better align WARM  to the VUSCA world - a world  of Volatility, Uncertainty, Complexity, and Ambiguity, and bring our best values to the Vietnamese people and communities affected by climate change.
                    </div>
                </div>
            </div>
        </section> -->
    </main>
<?php getFooter();?>