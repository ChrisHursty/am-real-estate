<div class="container-fw light-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-10 align-center text-center">
            <?php // Get fields from the Options Page
            $services_pricing_title = get_field('services_pricing_title', 'option');
            $services_pricing = get_field('services_pricing', 'option');
            $extension_pricing_title = get_field('extension_pricing_title', 'option');
            $extension_pricing = get_field('extension_pricing', 'option');
            $wysiwyg_content = get_field('pricing_disclaimer', 'option');

            // Output the Services Pricing Section
            if( $services_pricing_title ) {
                echo '<h2>' . esc_html($services_pricing_title) . '</h2>';
            }

            if( $services_pricing ) {
                echo '<ul class="pricing-list">';
                foreach( $services_pricing as $service ) {
                    echo '<li>';
                    echo '<span class="service-title">' . esc_html($service['service']) . '</span>';
                    echo '<span class="service-price">' . esc_html($service['price']) . '</span>';
                    echo '</li>';
                }
                echo '</ul>';
            }

            // Output the Extension Pricing Section
            if( $extension_pricing_title ) {
                echo '<h2>' . esc_html($extension_pricing_title) . '</h2>';
            }

            if( $extension_pricing ) {
                echo '<ul class="pricing-list">';
                foreach( $extension_pricing as $service ) {
                    echo '<li>';
                    echo '<span class="service-title">' . esc_html($service['service']) . '</span>';
                    echo '<span class="service-price">' . esc_html($service['price']) . '</span>';
                    echo '</li>';
                }
                echo '</ul>';
            }

            // Output the WYSIWYG content
            if( $wysiwyg_content ) {
                echo '<div class="additional-content">' . wp_kses_post($wysiwyg_content) . '</div>';
            }
            ?>

            </div>
            
        </div>
    </div>
</div>