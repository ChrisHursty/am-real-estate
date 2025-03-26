<div class="container-fw testimonial-container">
    <div class="container">
        <div class="row">
            <h2 class="align-center">Reviews</h2>
            <div class="owl-carousel testimonial-carousel">
                <?php
                $testimonials = new WP_Query(array(
                    'post_type'      => 'testimonial',
                    'posts_per_page' => -1 // Retrieve all testimonials
                ));

                if ($testimonials->have_posts()) {
                    while ($testimonials->have_posts()) {
                        $testimonials->the_post();

                        $company_name = get_post_meta(get_the_ID(), 'company_name', true); // Replace 'company_name' with your custom field key
                ?>

                <div class="item">
                    <blockquote>
                        <div class="open-quote">"</div>
                        <?php the_content(); ?>
                    </blockquote>
                    <div class="details">
                        <div class="name-company">
                            <p class="name">
                                <?php the_title(); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>
