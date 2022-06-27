<section <?php post_class('Page'); ?>>
    <div class="Top">
        <?php tr_title('tp_page', 'Title'); ?>
    </div>
    <div class="Description">
        <?php
            the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'toroplay' ),
				'after'  => '</div>',
			) );
        ?>
    </div>
</section>