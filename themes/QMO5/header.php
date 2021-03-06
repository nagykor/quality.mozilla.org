<?php
  // Fetch the category IDs
  $events_cat = get_category_by_slug('events')->cat_ID;
  $news_cat = get_category_by_slug('qmo-news')->cat_ID;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <!--[if IE]>
  <meta http-equiv="imagetoolbar" content="no">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <meta name="Rating" content="General">
  <meta name="MSSmartTagsPreventParsing" content="true">

  <meta name="viewport" content="width=device-width">

  <!-- For Facebook -->
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:title" content="<?php if (is_singular()) : single_post_title(); else : bloginfo('name'); endif; ?>">
  <meta property="og:url" content="<?php if (is_singular()) : the_permalink(); else : bloginfo('url'); endif; ?>">
  <meta property="og:description" content="<?php fc_meta_desc(); ?>">
  <meta property="og:image" content="<?php bloginfo('stylesheet_directory'); ?>/img/Q.png">

  <meta name="title" content="<?php if (is_singular()) : single_post_title(); echo ' | '; endif; bloginfo('name'); ?>">
  <meta name="description" content="<?php fc_meta_desc(); ?>">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="shortcut icon" type="image/ico" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico">
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> News and Events Feed" href="<?php bloginfo('rss2_url'); echo '?cat='.$news_cat.','.$events_cat; ?>">
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Community Feed" href="<?php bloginfo('rss2_url'); ?>">
  <link rel="home" href="<?php echo bloginfo('url'); ?>">
  <link rel="copyright" href="#copyright">

  <link rel="stylesheet" type="text/css" media="screen,projection" href="<?php bloginfo('stylesheet_url'); ?>">
  <!--[if lte IE 7]><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css"><![endif]-->
  <!--[if lte IE 6]><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie6.css"><![endif]-->
  <link rel="stylesheet" type="text/css" media="print,handheld" href="<?php bloginfo('stylesheet_directory'); ?>/css/print.css">
  <link href="//www.mozilla.org/tabzilla/media/css/tabzilla.css" rel="stylesheet">
  <script src="//www.mozilla.org/tabzilla/media/js/tabzilla.js"></script>

  <?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); ?>
  <?php if (is_singular()) : ?><link rel="canonical" href="<?php echo the_permalink(); ?>"><?php endif; ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php if (class_exists('The_Events_Calendar')) : ?><link rel="profile" href="http://microformats.org/profile/hcalendar"><?php endif; ?>

  <title><?php
    if ( is_single() ) { single_post_title(); echo ' &#124; '; bloginfo('name'); }
    elseif ( is_home() || is_front_page() ) { bloginfo('name'); echo ' &#124; '; bloginfo('description'); qmo_page_number(); }
    elseif ( is_day() ) { $post = $posts[0]; _e('Posts for ', 'qmo'); echo the_time('F jS, Y'); echo ' &#124; '; bloginfo('name'); qmo_page_number(); }
    elseif ( is_month() ) { $post = $posts[0]; _e('Posts for ', 'qmo'); echo the_time('F, Y'); echo ' &#124; '; bloginfo('name'); qmo_page_number(); }
    elseif ( is_year() ) { $post = $posts[0]; _e('Posts for ', 'qmo'); echo the_time('Y'); echo ' &#124; '; bloginfo('name'); qmo_page_number(); }
    else { wp_title('&#124;',1,'right'); bloginfo('name'); qmo_page_number(); } ?>
  </title>
  <?php wp_head(); ?>
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35433268-17']);
    _gaq.push(['_trackPageview']);
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
  <header id="masthead" class="section">
    <div id="header">
      <a href="http://www.mozilla.org/" id="tabzilla">Mozilla</a>
    </div><!-- end #header -->

    <div id="branding" role="banner">
    <?php if ( (is_front_page()) && ($paged < 1) ) : ?>
      <h1 id="logo"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/head-logo.png" alt="<?php bloginfo('name'); ?>"></h1>
    <?php else : ?>
      <h4 id="logo"><a href="<?php echo bloginfo('url'); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/head-logo.png" alt="<?php bloginfo('name'); ?>"></a></h4>
    <?php endif; ?>
    </div><!-- /#branding -->

    <nav id="site-nav">
      <ul id="nav-access" role="navigation">
        <li><a href="#content">Skip to main content</a></li>
        <li><a href="#search">Skip to search</a></li>
        <?php if (!is_user_logged_in()) : ?>
        <li><a href="<?php echo wp_login_url(); ?>">Log in</a></li>
        <?php endif; ?>
      </ul>

      <div class="section">
        <?php include (TEMPLATEPATH . '/main-nav.php'); ?>
      </div>
    </nav>
    <?php include (TEMPLATEPATH . '/searchform.php'); ?>
  </header><!-- /#masthead -->

  <div id="content" class="section">
