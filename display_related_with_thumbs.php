<?php
$original_post = $post;
$tags = wp_get_post_tags($post->ID);
if ($tags) {
  echo '<h2>Related Posts</h2>';
  $first_tag = $tags[0]->term_id;
  $args=array(
    'tag__in' => array($first_tag),
    'post__not_in' => array($post->ID),
    'showposts'=>4,
    'caller_get_posts'=>1
   );
  $my_query = new WP_Query($args);
  if( $my_query->have_posts() ) {
    echo "<ul>";
    while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <li><img src="<?php bloginfo('template_directory'); ?>/timthumb/timthumb.php?src=<?php echo get_post_meta($post->ID, "post-img", true); ?>&h=40&w=40&zc=1" alt="" /><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile;
    echo "</ul>";
  }
}
$post = $original_post;
wp_reset_query();
?>