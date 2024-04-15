<?php

// Populate ACF select field options with Gravity Forms forms 
function acf_populate_gf_forms_ids( $field ) {
	if ( class_exists( 'GFFormsModel' ) ) {
		$choices = array(
			'none' => 'None'
		);

		$forms = \GFFormsModel::get_forms();

		if ( $forms ) {
			foreach ( $forms as $form ) {
				$choices[ $form->id ] = $form->title;
			}
		}

		$field['choices'] = $choices;
	}

	return $field;
}
add_filter( 'acf/load_field/name=gravity_form', 'acf_populate_gf_forms_ids' );