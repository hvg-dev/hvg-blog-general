<?php
/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */
// phpcs:ignore
class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{
    // phpcs:ignore
    function widget($args, $instance)
    {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

        if (empty($instance['number']) || ! $number = absint($instance['number'])) {
            $number = 10;
        }

        $r = new WP_Query(apply_filters('widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true )));
        if ($r->have_posts()) :
            echo $before_widget;
            if ($title) {
                echo $before_title . $title . $after_title;
            } ?>
            <ul class="article-card-list__vertical">
            <?php while ($r->have_posts()) :
                $r->the_post(); ?>
        <li>
                <?php get_template_part('template-parts/content', 'preview');?>
        </li>
            <?php endwhile; ?>
            </ul>

            <?php
            echo $after_widget;

            wp_reset_postdata();
        endif;
    }
}
function my_recent_widget_registration()
{
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');


/*
Random posts widget
*/
// phpcs:ignore
class Random_Widget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'random_widget',
            'description' => 'Véletlenszerű bejegyzések megjelenítése',
        );
        parent::__construct('random_widget', 'Ajánló - ezek is érdekelhetnek', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? 'Ajánló - ezek is érdekelhetnek' : $instance['title'], $instance, $this->id_base);

        if (empty($instance['number']) || ! $number = absint($instance['number'])) {
            $number = 10;
        }

        $q_args = array(
            'orderby'        => 'rand',
            'posts_per_page' => '6',

        );
        $query = new WP_Query($q_args);
        if ($query->have_posts()) :
            echo $before_widget;
            if ($title) {
                echo $before_title . $title . $after_title;
            } ?>
            <ul class="article-card-list__thumbnails">
            <?php while ($query->have_posts()) :
                $query->the_post(); ?>
        <li>
                <?php get_template_part('template-parts/content', 'preview');?>
        </li>
            <?php endwhile; ?>
            </ul>

            <?php
            echo $after_widget;

            wp_reset_postdata();
        endif;
    }
}

add_action('widgets_init', function () {
    register_widget('Random_Widget');
});

// phpcs:ignore
class WP_Widget_ArchivesByYear extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
          'classname' => 'widget_archive_by_year',
          'description' => __('Archívum éves és havi bontásban'),
          'customize_selective_refresh' => true,
        );
        parent::__construct('archives_by_year', __('Archívum éves bontásban'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        global $wpdb;

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Archives') : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $year_prev = null;
        $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,
                      YEAR( post_date ) AS year,
                      COUNT( id ) as post_count FROM $wpdb->posts
                      WHERE post_status = 'publish' and post_date <= now( )
                      and post_type = 'post'
                      GROUP BY month , year
                      ORDER BY post_date DESC");
        echo '<div class="years-list">';
        foreach ($months as $month) :
            $year_current = $month->year;
            if ($year_current != $year_prev) {
                if ($year_prev != null) {?>
          </div>
                <?php } ?>
        <div class="years-list__year">
        <h3 class="year">
          <a href="<?php echo get_year_link($month->year); ?>"><?php echo $month->year ?></a>
        </h3>

        <ul class="months-list">
            <?php } ?>
        <li>
          <a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>">
            <span class="archive-month"><?php echo date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span>
            <span class="archive-dots"></span>
            <span class="archive-count"><?php echo $month->post_count; ?></span>
          </a>
        </li>
            <?php $year_prev = $year_current;
        endforeach;
        echo '</ul></div></div>';

        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
        $instance['title'] = sanitize_text_field($new_instance['title']);

        return $instance;
    }


    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array( 'title' => ''));
        $title = sanitize_text_field($instance['title']);
        ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <?php
    }
}


add_action('widgets_init', function () {
    register_widget('WP_Widget_ArchivesByYear');
});
