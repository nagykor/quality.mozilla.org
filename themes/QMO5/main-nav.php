<?php /* Assemble the main navigation menu with a bunch of conditionals for different tab states. */ 
$events_id = get_cat_ID('events');
global $bp;

$ancestors = get_post_ancestors($post->ID); // Return an array of all ancestors
$root = count($ancestors)-1; // Go to the end of that array
$parent = $ancestors[$root]; // Top parent is the last in the array
?>

<ul id="nav-main" role="navigation">
<?php // Home
  if ( (is_front_page()) && ($paged < 1) ) : ?>
  <li class="current" title="This is the current page"><em>Home</em></li>
<?php elseif (is_front_page()) : ?>
  <li class="current"><a href="<?php echo bloginfo('url'); ?>" rel="home">Home</a></li>
<?php else : ?>
  <li><a href="<?php echo bloginfo('url'); ?>" rel="home">Home</a></li>
<?php endif; ?>

<?php // Teams
  if ( get_page_by_path('teams') && (get_post_status( get_page_by_path('teams') ) === 'publish') ) :
    if ( is_page('teams') ) : ?>
  <li class="current" title="This is the current page"><em>Teams</em></li>
  <?php elseif (fc_is_child(get_page_by_path('teams')->ID)) : ?>
  <li class="current"><a href="<?php echo get_permalink(get_page_by_path('teams')->ID); ?>">Teams</a></li>
  <?php else : ?>
  <li><a href="<?php echo get_permalink(get_page_by_path('teams')->ID); ?>">Teams</a></li>
<?php endif;
  endif; ?>

<?php // Community
  if ( is_page('community') || is_category('syndicated') || is_category('twitter') ) : ?>
  <li class="current"><a href="<?php echo get_permalink(get_page_by_path('community')->ID); ?>">Community</a></li>
  <?php else : ?>
  <li><a href="<?php echo get_permalink(get_page_by_path('community')->ID); ?>">Community</a></li>
<?php endif; ?>

<?php // Events
  if ( is_term('events','category') ) :
    if ( is_category('events') && ($paged < 1) ) : ?>
  <li class="current" title="This is the current page"><em>Events</em></li>
<?php elseif ( is_category('events') ||
               (is_singular() && in_category('events')) ||
               (is_singular() && fc_in_descendant_category( get_term_by('name', 'events', 'category')) ) ) : ?>
  <li class="current"><a href="<?php echo get_category_link( $events_id ); ?>">Events</a></li>
<?php else : ?>
  <li><a href="<?php echo get_category_link( $events_id ); ?>">Events</a></li>
<?php endif; 
  endif; ?>
  
<?php // Media
  if ( get_page_by_path('media') && (get_post_status( get_page_by_path('media') ) === 'publish') ) :
    if ( is_page('media') ) : ?>
  <li class="current" title="This is the current page"><em>Media</em></li>
<?php elseif ( fc_is_child(get_page_by_path('media')->ID) ) : ?>
  <li class="current"><a href="<?php echo get_permalink(get_page_by_path('media')->ID); ?>">Media</a></li>
<?php else : ?>
  <li><a href="<?php echo get_permalink(get_page_by_path('media')->ID); ?>">Media</a></li>
<?php endif; 
  endif; ?>

<?php // Docs
  if (get_page_by_path('docs')) :
    if ( is_page('docs') ) : ?>
  <li class="last current" title="This is the current page"><em>Docs</em></li>
<?php elseif ( fc_is_child(get_page_by_path('docs')->ID) ) : ?>
  <li class="last current"><a href="<?php echo get_permalink(get_page_by_path('docs')->ID); ?>">Docs</a></li>
<?php else : ?>
  <li class="last"><a href="<?php echo get_permalink(get_page_by_path('docs')->ID); ?>">Docs</a></li>
<?php endif;
  endif; ?>  
</ul>
