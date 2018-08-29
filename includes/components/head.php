<head>
    <meta charset="UTF-8">
    <title>
        <?php // the_field('meta_title'); ?>
    </title>
    <meta name="description" content="<?php # the_field('meta_description'); ?>">
    <meta name="language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="Agência 3xceler">
    <meta name="language" content="pt-br" />
    <link rel="canonical" href="<?= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" />
    <!-- <meta name="theme-color" content="#FFFFFFF"> -->
    <?php wp_head(); ?>
</head>