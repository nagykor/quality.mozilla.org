<?php 
/*
Template Name: Team Page
*/
get_header(); ?>
<section id="content-main" class="hfeed" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); // The Loop ?>

  <?php if (fc_is_subpage()) : ?>
    <?php if(function_exists('bcn_display')) : ?>
    <p class="crumbs">
    <?php bcn_display(); ?>
    </p>
    <?php else : ?>
    <p class="crumbs"><a href="<?php echo get_permalink($post->post_parent); ?>" title="<?php _e('Return to &ldquo;'.get_the_title($post->post_parent).'&rdquo;','qmo'); ?>">&larr; <?php echo get_the_title($post->post_parent); ?></a></p>
    <?php endif; ?>    
  <?php endif;?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
      <h1 class="entry-title section-title"><?php the_title(); ?></h1>
      <div class="entry-content">
        <?php if (has_post_thumbnail()) : the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); endif; ?>
        <?php the_content('Read the rest of this entry &hellip;'); ?>
        <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number', 'link_before' => '<b>', 'link_after' => '</b>')); ?>
      </div>

    <?php if (get_the_tags()) : ?>
      <?php the_tags('<p class="entry-tags"><strong>Tags:</strong> ',', ',''); ?>
    <?php endif; ?>

    <?php if (is_user_logged_in()) : ?>
      <div class="entry-meta">
        <p class="vcard">Last modified by <a class="fn url author" title="See all <?php the_author_posts() ?> posts by <?php the_author(); ?>" href="<?php echo get_author_posts_url($authordata->ID, $authordata->user_nicename); ?>"><?php the_author(); ?></a>
        on <?php the_modified_time(get_option('date_format')); ?>
        at <time class="updated" pubdate datetime="<?php the_modified_time('Y-m-d\TH:i:sP'); ?>"><?php the_modified_time(); ?></time>.
        <?php if ( current_user_can( 'edit_page', $post->ID ) ) : ?><span class="edit"><?php edit_post_link('Edit', '', ''); ?></span><?php endif; ?>
        </p>
      </div>
    <?php endif; ?>
    </article>

    <?php endwhile; ?>

    <?php comments_template(); ?>

  <?php else : ?>

  <h1 class="section-title"><?php _e('Sorry, there&#8217;s nothing to see here.','qmo'); ?></h1>

<?php endif; ?>

</section><?php /* end #content-main */ ?>

<section id="content-sub" role="complementary">
<?php include (TEMPLATEPATH . '/user-state.php'); ?>

<?php $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0&sort_column=menu_order');
  if ($children) : ?>
  <div class="widget related_pages">
    <h3 class="widgettitle">Sub-teams</h3>
    <ul class="page-tree">
    <?php echo $children; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-team-single') ) : else : endif; ?>
</section>

<?php get_footer(); ?>
