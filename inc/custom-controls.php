<?php
if (class_exists('WP_Customize_Control')) {
  // Create custom range
  // phpcs:ignore
    class WP_Customize_Range_Control extends WP_Customize_Control
    {
        public $type = 'custom_range';
        public function enqueue()
        {
            wp_enqueue_script('custom_controls', get_template_directory_uri().'/inc/js/custom_controls.js', array( 'jquery' ), '', true);
            wp_enqueue_style('custom_controls_css', get_template_directory_uri().'/inc/css/custom_controls.css');
        }
        // phpcs:ignore
        public function render_content()
        {
            ?>
          <label>
              <?php if (! empty($this->label)) : ?>
                  <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
              <?php endif; ?>
              <div class="cs-range-value"><?php echo esc_attr($this->value()); ?></div>
              <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
              <?php if (! empty($this->description)) : ?>
                  <span class="description customize-control-description"><?php echo $this->description; ?></span>
              <?php endif; ?>
          </label>
            <?php
        }
    }
}
