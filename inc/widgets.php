<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function mytheme_register_sidebars()
{
    register_sidebar(array(
        'id'            => 'sidebar-1',
        'name'          => __('Primary Sidebar', 'amre-wp'),
        'description'   => __('The main sidebar appears on the right on each page except the front page template', 'amre-wp'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<hr><h2 class="widget-title">',
        'after_title'   => '</h2><hr>',
    ));
}
add_action('widgets_init', 'mytheme_register_sidebars');

class Random_Posts_Widget extends WP_Widget
{

    public function __construct()
    {
        $widget_options = array(
            'classname' => 'random_posts_widget',
            'description' => 'Displays 3 Random Blog Posts',
        );
        parent::__construct('random_posts_widget', 'Blog', $widget_options);
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $random_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'orderby' => 'rand'));
        if ($random_posts_query->have_posts()) {
            echo '<ul>';
            while ($random_posts_query->have_posts()) {
                $random_posts_query->the_post();
                echo '<li><a href="' . get_permalink() . '">';
                echo '<div class="sidebar-img">';
                if (has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail');
                }
                echo '</div><span>';
                echo get_the_title() . '</span></a></li>';
            }
            echo '</ul>';
        }
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : 'Random Blog Posts';
?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

class Random_Portfolio_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'random_portfolio_widget',
            'description' => 'Displays 3 Random Portfolio Posts',
        );
        parent::__construct('random_portfolio_widget', 'Random Portfolio Posts', $widget_options);
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Use a different variable name for WP_Query arguments to avoid overwriting the $args parameter
        $query_args = array(
            'post_type'      => 'portfolio',
            'posts_per_page' => 3,
            'orderby'        => 'rand',
        );
        $portfolio_query = new WP_Query($query_args);

        if ($portfolio_query->have_posts()) {
            echo '<ul class="random-portfolio-list">';
            while ($portfolio_query->have_posts()) {
                $portfolio_query->the_post();
                $thumbnail_id = get_post_meta(get_the_ID(), '_portfolio_thumbnail_id', true);
                $thumbnail_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';

                echo '<li class="portfolio-item">';
                echo '<a href="' . get_permalink() . '">';
                echo '<div class="sidebar-img">';
                
                if ($thumbnail_url) {
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '" style="width: 100%;">';
                }
                echo '</div><span>' . get_the_title() . '</span></a></li>';
            }
            echo '</ul>';
        }
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Random Portfolio Posts';
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
<?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}
