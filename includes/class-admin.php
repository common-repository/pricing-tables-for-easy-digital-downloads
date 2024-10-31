<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class PTF_Pricing_Tables_For_EDD_Admin {

	public function __construct() {
		add_filter( 'edd_metabox_fields_save', array( $this, 'save_meta' ) );
		add_action( 'edd_meta_box_price_fields', array( $this, 'settings' ), 100 );
	}

	/**
	 * Settings
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */
	public function settings( $download_id ) {

		?>
		<div id="pricing-tables-for-easy-digital-downloads-options-wrap">

			<?php
			/**
			 * Enable pricing table
			 */
			$checked = get_post_meta( $download_id, '_ptf_pricing_tables', true );
			?>
			<p>
				<input type="checkbox" name="_ptf_pricing_tables" id="ptf-pricing-tables" value="1"<?php checked( true, $checked ); ?>/>
				<label for="ptf-pricing-tables">
					<?php _e( 'Create pricing table', 'pricing-tables-for-easy-digital-downloads' ); ?>
				</label>
			</p>

			<?php
			/**
			 * Enable advanced options pricing table
			 */
			$advanced_options = get_post_meta( $download_id, '_ptf_pricing_tables_advanced_options', true );
			?>
			<p id="pricing-tables-for-easy-digital-downloads-advanced-options" style="display: none;">
				<input type="checkbox" name="_ptf_pricing_tables_advanced_options" id="ptf-pricing-tables-advanced-options" value="1"<?php checked( true, $advanced_options ); ?>/>
				<label for="ptf-pricing-tables-advanced-options">
					<?php _e( 'Show advanced options', 'pricing-tables-for-easy-digital-downloads' ); ?>
				</label>
			</p>

			<?php
			/**
			 * Variable pricing enabled
			 */
			if ( edd_has_variable_prices( $download_id ) ) : ?>

				<div id="pricing-tables-for-easy-digital-downloads-variable-pricing-options" style="display: none;">
				<?php

				$variable_prices = edd_get_variable_prices( $download_id );

				if ( $variable_prices ) : ?>

					<?php foreach ( $variable_prices as $key => $price ) :

						$features = isset( $price['features'] ) ? $price['features'] : '';

						$pricing_option_name          = ! empty( $price['pricing_option_name'] ) ? $price['pricing_option_name'] : '';
						$pricing_option_icon          = ! empty( $price['pricing_option_icon'] ) ? $price['pricing_option_icon'] : '';
						$pricing_option_description   = ! empty( $price['pricing_option_description'] ) ? $price['pricing_option_description'] : '';
						$pricing_option_period        = ! empty( $price['pricing_option_period'] ) ? $price['pricing_option_period'] : '';
						$featured_title               = ! empty( $price['featured_title'] ) ? $price['featured_title'] : '';
						$featured_text                = ! empty( $price['featured_text'] ) ? $price['featured_text'] : '';
						$button_text                  = ! empty( $price['button_text'] ) ? $price['button_text'] : '';
					?>
						<div style="border: 1px solid #e5e5e5; margin-bottom: 20px; padding: 0 20px 20px 20px;">

							<p><strong><?php echo esc_attr( $price['name'] ); ?></strong></p>

								<?php
								/**
								 * Pricing option name
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
									<p>
										<strong><label for="ptf-pricing-tables-pricing-option-name-<?php echo $key;?>"><?php _e( 'Pricing Option Name', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>
									<input class="large-text" type="text" name="edd_variable_prices[<?php echo $key; ?>][pricing_option_name]" id="ptf-pricing-tables-pricing-option-name-<?php echo $key;?>" value="<?php echo esc_attr( $pricing_option_name ); ?>" />
									<p class="description"><?php _e( 'Entering a pricing option name here will override the variable pricing option name above.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
								</div>

								<?php
								/**
								 * Pricing option icon
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
									<p>
										<strong><label for="ptf-pricing-tables-pricing-option-icon-<?php echo $key;?>"><?php _e( 'Pricing Option Icon', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>
									<input class="large-text" type="text" name="edd_variable_prices[<?php echo $key; ?>][pricing_option_icon]" id="ptf-pricing-tables-pricing-option-icon-<?php echo $key;?>" value="<?php echo esc_attr( $pricing_option_icon ); ?>" />
									<p class="description"><?php _e( 'You can select icon from <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a>, Eg.fa-diamond', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
								</div>

								<?php
								/**
								 * Pricing option description
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
									<p>
										<strong><label for="ptf-pricing-tables-pricing-option-description-<?php echo $key;?>"><?php _e( 'Pricing Option Description', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>
									<input class="large-text" type="text" name="edd_variable_prices[<?php echo $key; ?>][pricing_option_description]" id="ptf-pricing-tables-pricing-option-description-<?php echo $key;?>" value="<?php echo esc_attr( $pricing_option_description ); ?>" />
									<p class="description"><?php _e( 'Enter a pricing option description.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
								</div>

								<?php
								/**
								 * Period
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
									<p>
										<strong><label for="ptf-pricing-tables-pricing-option-name-<?php echo $key;?>"><?php _e( 'Pricing Option Period', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>
									<input class="large-text" type="text" name="edd_variable_prices[<?php echo $key; ?>][pricing_option_period]" id="ptf-pricing-tables-pricing-option-period-<?php echo $key;?>" value="<?php echo esc_attr( $pricing_option_period ); ?>" />
									<p class="description"><?php _e( 'Entering a pricing option period. E.g. per year.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
								</div>

								<?php
								/**
								 * Features
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap">
									<p>
										<strong><label for="ptf-pricing-tables-features-<?php echo $key;?>"><?php _e( 'Features', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>

									<textarea style="width:100%;" rows="5" class="large-textarea" name="edd_variable_prices[<?php echo $key; ?>][features]" id="ptf-pricing-tables-features-<?php echo $key;?>"><?php echo esc_textarea( $features ); ?></textarea>
									<p class="description"><?php _e( 'Enter features for this pricing option, one per line.', 'pricing-tables-for-easy-digital-downloads' ); ?></p>
								</div>

								<?php
								/**
								 * Featured text
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
									<p>
										<strong><label for="ptf-pricing-tables-featured-text-<?php echo $key;?>"><?php _e( 'Featured', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>
									<input type="checkbox" name="edd_variable_prices[<?php echo $key; ?>][featured_text]" id="ptf-pricing-tables-featured-text-<?php echo $key;?>" value="1"<?php checked( true, esc_attr( $featured_text ) ); ?> />
									<p class="description"><?php _e( 'Make this pricing option featured.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
								</div>

								<?php
								/**
								 * Button text
								 */
								?>
								<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
									<p>
										<strong><label for="ptf-pricing-tables-button-text-<?php echo $key;?>"><?php _e( 'Button Text', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
									</p>
									<input class="large-text" type="text" name="edd_variable_prices[<?php echo $key; ?>][button_text]" id="ptf-pricing-tables-featured-text-<?php echo $key;?>" value="<?php echo esc_attr( $button_text ); ?>" />
									<p class="description"><?php _e( 'E.g. Purchase', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
								</div>


						</div>
					<?php endforeach; ?>

				<?php endif; ?>
				</div>


			<?php else : // single download ?>

				<?php
				$features      = get_post_meta( $download_id, '_pricing_tables_for_edd_features', true );
				$featured_text = get_post_meta( $download_id, '_pricing_tables_for_edd_featured_text', true );
				$button_text   = get_post_meta( $download_id, '_pricing_tables_for_edd_button_text', true );
				$option_name   = get_post_meta( $download_id, '_pricing_tables_for_edd_option_name', true );
				$option_icon   = get_post_meta( $download_id, '_pricing_tables_for_edd_option_icon', true );
				$option_desc   = get_post_meta( $download_id, '_pricing_tables_for_edd_option_description', true );
				$option_period = get_post_meta( $download_id, '_pricing_tables_for_edd_option_period', true );
				?>
				<div>

					<?php
					/**
					 * Pricing option name
					 */
					?>
					<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
						<p>
							<strong><label for="ptf-pricing-tables-option-name"><?php _e( 'Pricing Option Name', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
						</p>
						<input class="large-text" type="text" name="_pricing_tables_for_edd_option_name" id="ptf-pricing-tables-option-name" value="<?php echo esc_attr( $option_name ); ?>" />
						<p class="description"><?php _e( 'Entering an option title here will replace the download title on the pricing table.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
					</div>

					<?php
					/**
					 * Pricing option icon
					 */
					?>
					<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
						<p>
							<strong><label for="ptf-pricing-tables-option-icon"><?php _e( 'Pricing Option Icon', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
						</p>
						<input class="large-text" type="text" name="_pricing_tables_for_edd_option_icon" id="ptf-pricing-tables-option-icon" value="<?php echo esc_attr( $option_icon ); ?>" />
						<p class="description"><?php _e( 'You can select icon from <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a>, Eg:fa-diamond.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
					</div>

					<?php
					/**
					 * Pricing option description
					 */
					?>
					<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
						<p>
							<strong><label for="ptf-pricing-tables-option-description"><?php _e( 'Pricing Option Description', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
						</p>
						<input class="large-text" type="text" name="_pricing_tables_for_edd_option_description" id="ptf-pricing-tables-option-description" value="<?php echo esc_attr( $option_desc ); ?>" />
						<p class="description"><?php _e( 'Enter a pricing option description.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
					</div>

					<?php
					/**
					 * Pricing period
					 */
					?>
					<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
						<p>
							<strong><label for="ptf-pricing-tables-option-period"><?php _e( 'Pricing Option Period', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
						</p>
						<input class="large-text" type="text" name="_pricing_tables_for_edd_option_period" id="ptf-pricing-tables-option-period" value="<?php echo esc_attr( $option_period ); ?>" />
						<p class="description"><?php _e( 'Entering a pricing option period. E.g. per year.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
					</div>

					<?php
					/**
					 * Features
					 */
					?>
					<textarea style="width:100%;" rows="5" class="large-textarea" name="_pricing_tables_for_edd_features" id="ptf-pricing-tables-features-field"><?php echo esc_textarea( $features ); ?></textarea>
					<p><?php _e( 'Enter one feature per line.', 'pricing-tables-for-easy-digital-downloads' ); ?></p>

					<?php
					/**
					 * Featured text
					 */
					?>
					<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
						<p>
							<strong><label for="ptf-pricing-tables-featured-text"><?php _e( 'Featured', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
						</p>
						<input type="checkbox" name="_pricing_tables_for_edd_featured_text" id="ptf-pricing-tables-featured-text" value="1"<?php checked( true, esc_attr( $featured_text )); ?> />
						<p class="description"><?php _e( 'Make this pricing option featured.', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
					</div>

					<?php
					/**
					 * Button text
					 */
					?>
					<div class="pricing-tables-for-easy-digital-downloads-option-wrap pricing-tables-for-easy-digital-downloads-option-advanced" style="display: none;">
						<p>
							<strong><label for="ptf-pricing-tables-button-text"><?php _e( 'Button Text', 'pricing-tables-for-easy-digital-downloads' ); ?></label></strong>
						</p>
						<input class="large-text" type="text" name="_pricing_tables_for_edd_button_text" id="ptf-pricing-tables-button-text" value="<?php echo esc_attr( $button_text ); ?>" />
						<p class="description"><?php _e( 'E.g. Purchase', 'pricing-tables-for-easy-digital-downloads' );  ?></p>
					</div>

				</div>

			<?php endif; ?>

		</div>
		<?php
	}

	/**
	 * Save meta
	 */
	public function save_meta( $fields ) {

		$fields[] = '_ptf_pricing_tables';
		$fields[] = '_ptf_pricing_tables_advanced_options';

		// Single download
		$fields[] = '_pricing_tables_for_edd_features';
		$fields[] = '_pricing_tables_for_edd_featured_text';
		$fields[] = '_pricing_tables_for_edd_button_text';
		$fields[] = '_pricing_tables_for_edd_option_name';
		$fields[] = '_pricing_tables_for_edd_option_icon';
		$fields[] = '_pricing_tables_for_edd_option_description';
		$fields[] = '_pricing_tables_for_edd_option_period';


		return $fields;

	}

}
new PTF_Pricing_Tables_For_EDD_Admin;
