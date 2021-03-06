<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
    <head profile="http://gmpg.org/xfn/11">
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="robots" content="noodp,noydir" />
        <link rel="Shortcut Icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" type="image/x-icon" />
        <title><?php bloginfo('name'); ?></title>

        <?php // do_action('bp_head') ?>

        <link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>
        <div class="container-fluid">