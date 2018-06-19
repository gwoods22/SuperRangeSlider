<?php
class SL_VC_Element_SRS {

	public function __construct() {
		add_action( 'vc_before_init', [ $this, 'register' ] );
		add_shortcode( 'sl_srs', [ $this, 'callback' ] );
	}

	public function register() {
		vc_map( [
			'name' => __( 'Super Range Slider', '' ),
			'base' => 'sl_srs',
			'class' => '',
			'category' => __( 'Custom Elements', '' ),
			'params' => [
				[
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Slider Title', '' ),
					'param_name' => 'title',
					'value' => 'You Can Save',
					'group' => 'Content'
				],
        [
					'type' => 'dropdown',
					'value' => array(
						'Yes' => '0',
						'No'  => '1'
					),
					'holder' => 'div',
					'class' => '',
					'std' => 'Yes',
					'heading' => __( 'Show Arrows', '' ),
					'param_name' => 'hide-arrows',
					'group' => 'Content'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Interval Value', '' ),
          'description' => __( 'Intervals that the slider will lock to. Min, Mid, and Max must all be multiples of this.', '' ),
					'param_name' => 'intervals',
					'value' => '25000',
					'group' => 'Content'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Minimum Value', 'my-text-domain' ),
          'description' => __( 'Low end of the slider', 'my-text-domain' ),
					'param_name' => 'min-price',
					'value' => '200000',
					'group' => 'Content'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Middle Value', '' ),
          'description' => __( 'Middle and starting point of the slider', '' ),
					'param_name' => 'mid-price',
					'value' => '800000',
					'group' => 'Content'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Maximum Value', '' ),
          'description' => __( 'High end of the slider', '' ),
					'param_name' => 'max-price',
					'value' => '2000000',
					'group' => 'Content'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Savings Percentage', '' ),
          'description' => __( 'Decimal value for the percentage of the price you could save', '' ),
					'param_name' => 'save-decimal',
					'value' => '0.01695',
					'group' => 'Content'
				],
        [
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Slider Knob Color', '' ),
					'param_name' => 'knob-color',
					'value' => '#000',
					'group' => 'Styling'
				],
        [
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Slider Knob Border Color', '' ),
					'param_name' => 'knob-border-color',
					'value' => '#B0B0B0',
					'group' => 'Styling'
				],
        [
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Slider Bar Color', '' ),
					'param_name' => 'slider-color',
					'value' => '#D3D3D3',
					'group' => 'Styling'
				],
        [
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Arrow Color', '' ),
					'param_name' => 'arrow-color',
					'value' => '#D3D3D3',
					'group' => 'Styling'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Slider height (px)', '' ),
          'description' => __( 'Height of slider bar', '' ),
					'param_name' => 'slider-height',
					'value' => '2',
					'group' => 'Styling'
				],
        [
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
          'heading' => __( 'Extra class name', '' ),
          'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', '' ),
					'param_name' => 'class-name',
					'group' => 'Styling'
				],
			]
		] );
	}

	public function callback( $atts ) {
		$atts = shortcode_atts( [
      'title' => '',
			'hide-arrows' => '',
      'min-price' => '',
      'mid-price' => '',
      'max-price' => '',
      'intervals' => '',
      'save-decimal' => '',
			'knob-color' => '',
			'knob-border-color' => '',
			'slider-color' => '',
			'arrow-color' => '',
			'slider-height' => '',
			'class-name' => ''
		], $atts, 'sl_srs' );

		ob_start();

		include __DIR__ . '/srs.php';

		return ob_get_clean();
	}

}
