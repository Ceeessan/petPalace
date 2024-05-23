<?php get_header(); ?>

<div class="blog-content">
    <h1>Pet Palaces Blogg</h1>
    <p class="about-blog">Vi älskar alla djur och har samlat information om många av våra sällskapsdjur här. 
        Få tips om allt från hur du får din kanin rumsren till skötselråd av hundar.</p>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry-content">
                <p class="post-date"><?php the_time('j F, Y'); ?></p>

                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $wp_query->max_num_pages
            ));
            ?>
        </div>
    <?php else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
