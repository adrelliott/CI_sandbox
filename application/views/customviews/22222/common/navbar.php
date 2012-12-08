<p> this si the CUSTOM (22222) navbar</p>

<nav class="container"><!-- Start Navbar-->
    <ul class="sf-menu mobile-hide row clearfix">
        <?php 
            foreach($navbarHTML as $n) { echo $n; } //this var is passed via $data
        ?>
    </ul>
</nav><!-- End Navbar-->
