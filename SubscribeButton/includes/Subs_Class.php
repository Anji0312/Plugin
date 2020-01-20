<?php
/**
 * Adds Subscribe_Button widget.
 */
 class Subscribe_Button_Widget extends WP_Widget {
  
    /**
     * Register widget with WordPress.
     */
    function __construct() {
      parent::__construct(
        'subscribe_widget', // Base ID
        esc_html__( 'Subscribe Button', 'wps_domain' ), // Name
        array( 'description' => esc_html__( 'Widget to display Subscribe Button', 'wps_domain' ), ) // Args
      );
    }
  // 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
      echo $args['before_widget']; // Whatever you want to display before widget (<div>, etc)

      if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }

      // Widget Content Output
     // <div class="g-ytsubscribe" data-channelid="UCV-GtPzpGpLP48_Ws2t-usA" data-layout="full" data-count="default"></div>
    

      echo '<div class="g-ytsubscribe" data-channel="'.$instance['channel'].'" data-layout="'.$instance['layout'].'" 
      data-count="'.$instance['subcount'].'"></div>';


      echo $args['after_widget']; // Whatever you want to display after widget (</div>, etc)
    }
  
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */ 
    public function form( $instance ) {
      $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Subscribe Button', 'wps_domain' ); 
      
      $channel = ! empty( $instance['channel'] ) ? $instance['channel'] : esc_html__( 'BrisbaneBarConsultant', 'wps_domain' ); 

      $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( 'default', 'wps_domain' ); 

      $subcount = ! empty( $instance['subcount'] ) ? $instance['subcount'] : esc_html__( 'default', 'wps_domain' ); 
  
      ?>
      
      
      
      <!-- TITLE -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
          <?php esc_attr_e( 'Title:', 'wps_domain' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $title ); ?>">
      </p>

      <!-- CHANNEL -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>">
          <?php esc_attr_e( 'Channel:', 'wps_domain' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'channel' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $channel ); ?>">
      </p>

      <!-- LAYOUT -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>">
          <?php esc_attr_e( 'Layout:', 'wps_domain' ); ?>
        </label> 

        <select 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
          <option value="default" <?php echo ($layout == 'default') ? 'selected' : ''; ?>>
            Default
          </option>
          <option value="full" <?php echo ($layout == 'full') ? 'selected' : ''; ?>>
            Full
          </option>
        </select>
      </p>

      <!-- SUBCOUNT -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'subcount' ) ); ?>">
          <?php esc_attr_e( 'SubCount:', 'wps_domain' ); ?>
        </label> 

        <select 
          class="widefat" t
          id="<?php echo esc_attr( $this->get_field_id( 'subcount' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'subcount' ) ); ?>">
          <option value="default" <?php echo ($subcount == 'default') ? 'selected' : ''; ?>>
            Default
          </option>
          <option value="hidden" <?php echo ($subcount == 'hidden') ? 'selected' : ''; ?>>
            Hidden
          </option>
        </select>
      </p>
      <?php 
    }
  
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
      $instance = array();

      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

      $instance['channel'] = ( ! empty( $new_instance['channel'] ) ) ? strip_tags( $new_instance['channel'] ) : '';

      $instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';

      $instance['subcount'] = ( ! empty( $new_instance['subcount'] ) ) ? strip_tags( $new_instance['subcount'] ) : '';
  
      return $instance;
    }
  
  } // class 