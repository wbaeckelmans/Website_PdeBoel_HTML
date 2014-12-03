<?php include('menu.php'); ?>
<!-- begin header -->
<header id="header" class="container">
    <!-- begin header top -->
    <section id="header-top" class="clearfix">
        <!-- begin header left -->
        <div class="one-half">
            <h1 id="logo"><a href="index.php"><img src="images/logo.png" alt="Finesse"></a></h1>
            <p id="tagline">Responsive Business Theme</p>
        </div>
        <!-- end header left -->

        <!-- begin header right -->
        <div class="one-half column-last">
            <!-- begin language switcher -->
            <div id="polyglotLanguageSwitcher">
                <form action="#">
                    <select id="polyglot-language-options">
                        <option id="en" value="en" selected>English</option>
                        <option id="fr" value="fr">Fran&ccedil;ais</option>
                        <option id="de" value="de">Deutsch</option>
                        <option id="it" value="it">Italiano</option>
                        <option id="es" value="es">Espa&ntilde;ol</option>
                    </select>
                </form>
            </div>
            <!-- end language switcher -->

            <!-- begin contact info -->
            <div class="contact-info">
                <p class="phone">(123) 456-7890</p>
                <p class="email"><a href="mailto:info@finesse.com">info@finesse.com</a></p>
            </div>
            <!-- end contact info -->
        </div>
        <!-- end header right -->
    </section>
    <!-- end header top -->

    <!-- begin navigation bar -->
    <section id="navbar" class="clearfix">
        <!-- begin navigation -->
        <nav id="nav">
            <?php print_main_menu(); ?>
        </nav>
        <!-- end navigation -->

        <!-- begin search form -->
        <form id="search-form" action="search.php" method="get">
            <input id="s" type="text" name="s" placeholder="Search &hellip;" style="display: none;">
            <input id="search-submit" type="submit" name="search-submit" value="Search">
        </form>
        <!-- end search form -->
    </section>
    <!-- end navigation bar -->

</header>
<!-- end header -->