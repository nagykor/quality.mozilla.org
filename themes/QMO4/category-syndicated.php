<?php
// Fetch some IDs
$events_cat = get_category_by_slug('events')->cat_ID;
$synd_cat = get_category_by_slug('syndicated')->cat_ID;
$twitter_cat = get_category_by_slug('twitter')->cat_ID;

// Fetch the formats
$date_format = get_option("date_format");
$time_format = get_option("time_format");

get_header(); ?>
<section id="content-main" class="hfeed vcalendar" role="main">
<?php if (!is_front_page()) : ?>
<ul id="stream-filter">
  <li><a class="<?php if (is_home()) : echo 'button on'; else : echo 'button'; endif; ?>" href="<?php echo get_permalink(get_page_by_path('blog')->ID); ?>">All</a></li>
  <li><a class="<?php if (is_category($synd_cat)) : echo 'button on'; else : echo 'button'; endif; ?>" href="<?php echo get_category_link($synd_cat); ?>">Blogs</a></li>
  <li><a class="<?php if (is_category($twitter_cat)) : echo 'button on'; else : echo 'button'; endif; ?>" href="<?php echo get_category_link($twitter_cat); ?>">Tweets</a></li>
</ul>
<?php endif; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); // The Loop ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('syndicated'); ?> role="article">
    <h1 class="entry-title <?php if ( function_exists('is_event') && is_event() ) : echo 'summary'; endif; ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent link to &#8220;<?php the_title_attribute(); ?>&#8221;" <?php if ( function_exists('is_event') && is_event() ) : echo 'class="url"'; endif; ?>><?php the_title(); ?></a></h1>
    <div class="entry-meta">
      <p class="entry-posted">
        <a class="posted-month" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" title="See all posts from <?php echo get_the_time('F, Y'); ?>"><?php the_time('M'); ?></a>
        <span class="posted-date"><?php the_time('j'); ?></span>
        <span class="posted-year"><?php the_time('Y'); ?></span>
        <time class="updated" pubdate datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time(); ?></time>
      </p>
      <p>Syndicated from <a href="<?php the_syndication_source_link(); ?>" rel="nofollow external"><?php the_syndication_source(); ?></a></p>
    </div>

    <div class="entry-content">
      <?php if (has_post_thumbnail()) : the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); endif; ?>
      <?php the_content(__('Read more&hellip;', 'qmo')); ?>
      <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'next', 'link_before' => '<b>', 'link_after' => '</b>')); ?>
    </div>

    <?php if (get_the_tags()) : ?>
      <?php the_tags('<p class="entry-tags"><strong>'.__('Tags:','qmo').'</strong> ',', ',''); ?>
    <?php endif; ?>

  <?php $comment_count = get_comment_count($post->ID);
  if ( comments_open() || $comment_count['approved'] > 0 ) : ?>
    <ul class="discuss">
      <li class="comment-count"><a href="<?php comments_link() ?>"><?php comments_number(__('No comments yet', 'qmo'),__('1 comment', 'qmo'),__('% comments', 'qmo')); ?></a></li>
    <?php if ( comments_open() ) : ?>
      <li class="comment-post"><a href="<?php the_permalink() ?>#respond"><?php _e('Post a comment', 'qmo'); ?></a></li>
    <?php else : ?>
      <li class="comment-closed"><em><?php _e('Comments closed', 'qmo'); ?></em></li>
    <?php endif; ?>
    </ul>
  <?php endif; ?>
  </article><!-- /post -->

<?php endwhile; ?>

    <?php if (fc_show_posts_nav()) : ?>
      <?php if (function_exists('fc_pagination') ) : fc_pagination(); else: ?>
        <ul class="nav-paging">
          <?php if ( $paged < $wp_query->max_num_pages ) : ?><li class="prev"><?php next_posts_link(__('Previous','qmo')); ?></li><?php endif; ?>
          <?php if ( $paged > 1 ) : ?><li class="next"><?php previous_posts_link(__('Next','qmo')); ?></li><?php endif; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>

<?php else : // if there are no posts ?>

  <h1 class="section-title"><?php _e('Sorry, there&#8217;s nothing to see here.','qmo'); ?></h1>

<?php endif; ?>

</section><?php /* end #content-main */ ?>

<section id="content-sub" class="vcalendar" role="complementary">
<?php include (TEMPLATEPATH . '/user-state.php'); ?>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-community') ) : else : endif; ?>
</section>
<?php get_footer(); ?>
