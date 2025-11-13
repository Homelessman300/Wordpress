<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
<?php wp_head(); ?>
 <link rel="stylesheet" href="<?php 
        $href = function_exists('get_stylesheet_uri') ? get_stylesheet_uri() : 'style.css'; 
        echo function_exists('esc_url') ? esc_url($href) : $href; 
    ?>" type="text/css" />
</head>
<body <?php body_class(); ?>>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>" class="logo" />
        </a>

<!-- Drie nieuwste posts -->
<nav class="links">
    <ul>
        <?php
        $recent_posts = new WP_Query(array(
            'posts_per_page' => 3,
            'post_status'    => 'publish'
        ));

        if ($recent_posts->have_posts()) :
            while ($recent_posts->have_posts()) :
                $recent_posts->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </li>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <li><a href="#">Geen recente berichten</a></li>
            <?php
        endif;
        ?>
    </ul>
</nav>


        <!-- Secondary navigation (main) -->
        <nav class="main">
            <ul>
                <li class="search">
                    <a class="fa-search" href="#search">Search</a>
                    <form id="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="text" name="s" placeholder="Search" />
                    </form>
                </li>
                <li class="menu">
                    <a class="fa-bars" href="#menu">Menu</a>
                </li>
            </ul>
        </nav>
    </header>

<!-- Off-canvas menu -->
<section id="menu">

    <!-- Search -->
    <section>
        <form class="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" placeholder="Search" />
        </form>
    </section>

    <!-- Recent posts -->
    <section>
        <ul class="links">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 4, // Aantal posts dat je wilt tonen
                'post_status' => 'publish'
            ));

            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        </a>
                    </li>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <li>
                    <a href="#">
                        <h3>No posts found</h3>
                        <p>There are currently no posts to display.</p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </section>

</section>


<?php wp_footer(); ?>
</body>
</html>