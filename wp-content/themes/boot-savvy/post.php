<?php get_header(); ?>

<div id="content" class="hfeed row">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div <?php post_class('col-sm-18'); ?>>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <?php bootsavvy_post_conditionals(); ?>
                
            </div><!--hentry-->

        <?php
        endwhile;
    endif;
    ?>

</div><!--#content-->

<?php get_footer(); ?>