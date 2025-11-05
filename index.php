<?php include 'header.php'; ?>

<!-- Main -->
<div id="main">

    <?php
    // Custom Query - change args as needed
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Featured image or fallback
            if ( has_post_thumbnail() ) {
                $featured_img = get_the_post_thumbnail( get_the_ID(), 'featured-rectangular', array('class'=>'image featured') );
            } else {
                $fallback = esc_url( get_theme_file_uri('images/pic01.jpg') ); // change fallback per post if needed
                $featured_img = '<a href="' . get_permalink() . '" class="image featured"><img src="' . $fallback . '" alt="' . esc_attr(get_the_title()) . '" /></a>';
            }
    ?>
        <article class="post">
            <header>
                <div class="title">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                </div>
                <div class="meta">
                    <time class="published" datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                    <a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta('ID')) ); ?>" class="author">
                        <span class="name"><?php the_author(); ?></span>
                        <img src="<?php echo esc_url( get_avatar_url( get_the_author_meta('ID'), array('size'=>45) ) ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>" />
                    </a>
                </div>
            </header>

            <?php
            // If we already built $featured_img as an <a> (fallback), echo it. If it's the_post_thumbnail markup, ensure it links to permalink.
            if ( strpos( $featured_img, 'class="image featured"' ) !== false ) {
                // $featured_img already contains the full <a><img> (fallback case)
                echo $featured_img;
            } else {
                // has_post_thumbnail() case - wrap thumbnail in permalink anchor and add class
                ?>
                <a href="<?php the_permalink(); ?>" class="image featured"><?php the_post_thumbnail('featured-rectangular'); ?></a>
                <?php
            }
            ?>

            <p><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>

            <footer>
                <ul class="actions">
                    <li><a href="<?php the_permalink(); ?>" class="button large">Continue Reading</a></li>
                </ul>
                <ul class="stats">
                    <li><?php the_category(', '); ?></li>
                    <li><a href="<?php comments_link(); ?>" class="icon solid fa-comment"><?php comments_number('0','1','%'); ?></a></li>
                </ul>
            </footer>
        </article>

    <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>

    <!-- Pagination -->
    <ul class="actions pagination">
        <li><?php previous_posts_link('&laquo; Previous Page'); ?></li>
        <li><?php next_posts_link('Next Page &raquo;', $query->max_num_pages); ?></li>
    </ul>

</div>

<!-- Sidebar -->
<section id="sidebar">

    <!-- Intro -->
    <section id="intro">
        <header>
            <h2>GreenTech Solutions</h2>
            <p>Lorem ipsum</p>
        </header>
    </section>

    <!-- Mini Posts (most recent 4) -->
    <section>
        <div class="mini-posts">
            <?php
            $mini_args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
            );
            $mini_query = new WP_Query($mini_args);
            if ($mini_query->have_posts()) :
                while ($mini_query->have_posts()) : $mini_query->the_post();
                    // thumbnail or fallback
                    if ( has_post_thumbnail() ) {
                        $thumb = get_the_post_thumbnail( get_the_ID(), 'mini-rectangular' );
                    } else {
                        $thumb_img = esc_url( get_theme_file_uri('images/avatar.jpg') );
                        $thumb = '<img src="' . $thumb_img . '" alt="' . esc_attr(get_the_title()) . '" />';
                    }
            ?>
                <article class="mini-post">
                    <header>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <time class="published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta('ID')) ); ?>" class="author">
                            <img src="<?php echo esc_url( get_avatar_url( get_the_author_meta('ID'), array('size'=>48) ) ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>" />
                        </a>
                    </header>
                    <a href="<?php the_permalink(); ?>" class="image"><?php echo $thumb; ?></a>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No mini posts.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- Posts List (with thumbnails) -->
    <section>
        <ul class="posts">
            <?php
            $list_args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
            );
            $list_query = new WP_Query($list_args);
            if ($list_query->have_posts()) :
                while ($list_query->have_posts()) : $list_query->the_post();
                    if ( has_post_thumbnail() ) {
                        $small_thumb = get_the_post_thumbnail( get_the_ID(), 'sidebar-thumb' );
                    } else {
                        $small_fallback = esc_url( get_theme_file_uri('images/pic08.jpg') );
                        $small_thumb = '<img src="' . $small_fallback . '" alt="' . esc_attr(get_the_title()) . '" />';
                    }
            ?>
                <li>
                    <article>
                        <header>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <time class="published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        </header>
                        <a href="<?php the_permalink(); ?>" class="image"><?php echo $small_thumb; ?></a>
                    </article>
                </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<li>No posts available.</li>';
            endif;
            ?>
        </ul>
    </section>

    <!-- About -->
    <section class="blurb">
        <h2>About</h2>
        <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl...</p>
        <ul class="actions">
            <li><a href="#" class="button">Learn More</a></li>
        </ul>
    </section>

    <!-- Footer -->
    <section id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
            <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
        </ul>
        <p class="copyright">&copy; <?php echo date('Y'); ?> GreenTech Solutions.</p>
    </section>

</section>

<?php get_footer(); ?>
