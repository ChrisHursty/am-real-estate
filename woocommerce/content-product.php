<?php

/**
 * Custom grid card for shop archive
 */

defined('ABSPATH') || exit;
global $product;
?>

<div class="col-md-3 col-sm-12 archive-card">

	<?php if (has_post_thumbnail($product->get_id())) : ?>
		<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
			<?php echo get_the_post_thumbnail($product->get_id(), 'medium', ['class' => 'img-fluid card-img']); ?>
		</a>
	<?php endif; ?>

	<h2 class="archive-card-title">
		<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
			<?php echo esc_html(get_the_title($product->get_id())); ?>
		</a>
	</h2>

	<div class="archive-card-excerpt">
		<?php
		// use the short description as excerpt
		echo wp_kses_post(wpautop($product->get_short_description()));
		?>
	</div>

	<div class="archive-card-price">
		<?php echo $product->get_price_html(); ?>
	</div>

	<div class="archive-btns">
		<?php
		// a) Add to cart (with your 1–4 cap in place)
		woocommerce_template_loop_add_to_cart();
		?>

		<?php
		// b) Buy Now → add 1 ticket & go straight to cart
		$buy_now_url = wc_get_cart_url() . '?add-to-cart=' . $product->get_id() . '&quantity=1';
		?>
		<a href="<?php echo esc_url($buy_now_url); ?>" class="amre-btn buy-now">
			<?php esc_html_e('Buy Now', 'amre'); ?>
		</a>
	</div>

</div>