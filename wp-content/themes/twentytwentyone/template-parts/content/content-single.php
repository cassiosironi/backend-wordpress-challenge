<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<?php twenty_twenty_one_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<h5>Carga horária: <?php the_field('carga_horaria'); ?></h5>
		<h5>Inscrições abertas até: <?php the_field('data_limite'); ?></h5>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'twentytwentyone') . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__('Page %', 'twentytwentyone'),
			)
		);
		?>

		<br>
		<hr>
		<?php
		$data1 = get_field('data_limite');
		$data2 = date('d/m/Y');

		?>

		<?php if (($data1) > ($data2)) { ?>

			<h3>Tenho interesse</h3>
			<?php echo do_shortcode('[contact-form-7 id="8" title="Tenho interesse"]'); ?>

		<?php } else { ?>

			<?php echo $data1 . '|' . $data2 ;?>

			<h3>Inscrições encerradas!</h3>

		<?php } ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if (!is_singular('attachment')) : ?>
		<?php get_template_part('template-parts/post/author-bio'); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->