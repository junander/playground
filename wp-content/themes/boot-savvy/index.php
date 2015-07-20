<?php get_header(); ?>

<div id="content" class="hfeed row">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div <?php post_class('col-sm-18'); ?>>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-content"><?php the_content(); ?></div>
            </div><!--hentry-->

        <?php
        endwhile;
    endif;
    ?>

</div><!--#content-->

<?php get_footer(); ?>