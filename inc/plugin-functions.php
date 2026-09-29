<?php
add_action( 'gform_after_submission', 'post_to_third_party', 10, 2 );
function post_to_third_party( $entry, $form ){
if ( rgar( $entry, 'status' ) === 'spam' ) {
return false;
}
$body = [];
function dupeCheck($fieldName, $bodyData) {
$cleanLabel = substr(preg_replace("/[^a-zA-Z0-9]+/", "", $fieldName), 0, 24);
for ($x = 0; $x <= 20; $x++) {
if(array_key_exists($cleanLabel, $bodyData)) {
$cleanLabel = $cleanLabel . $x;
} else { break; }
}
return $cleanLabel;
}
$formFields = $form['fields'];
foreach($formFields as $formField):
if($formField['label'] == 'leadgen_base_uri' || $formField['label'] == 'sharpspring_base_uri') {
$base_uri = rgar( $entry, $formField['id']);
$sendToLeadGen = true;
} elseif($formField['label'] == 'leadgen_endpoint' || $formField['label'] == 'sharpspring_endpoint') {
$post_endpoint = rgar( $entry, $formField['id']);
} elseif($formField['label'] == 'support_test') {
$support_endpoint = rgar( $entry, $formField['id']);
$testMode = true;
} elseif($formField['type'] == 'multiselect') {
$fieldNumber = $formField['id'];
$fieldLabel = dupeCheck($formField['label'], $body);
$tempValue = rgar ( $entry, strval($fieldNumber) );
$trimmedValue = str_replace('[', '', $tempValue);
$trimmedValue = str_replace(']', '', $trimmedValue);
$trimmedValue = str_replace('"', '', $trimmedValue);
$body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = $trimmedValue;
} elseif($formField['inputs']) {
if($formField['type'] == 'checkbox') {
$fieldNumber = $formField['id'];
$fieldLabel = dupeCheck($formField['label'], $body);
$checkBoxField = GFFormsModel::get_field( $form, strval($fieldNumber) );
$tempValue = is_object( $checkBoxField ) ? $checkBoxField->get_value_export( $entry ) : '';
$trimmedValue = str_replace(', ', ',', $tempValue);
$body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = $trimmedValue;
} elseif($formField['type'] == 'time') {
$fieldNumber = $formField['id'];
$fieldLabel = dupeCheck($formField['label'], $body);
$body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = rgar( $entry, strval($fieldNumber) );
} elseif($formField['type'] == 'date') {
$fieldNumber = $formField['id'];
$fieldLabel = dupeCheck($formField['label'], $body);
$body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = rgar( $entry, strval($fieldNumber) );
} else {
foreach($formField['inputs'] as $subField):
$fieldLabel = dupeCheck($subField['label'], $body);
$fieldNumber = $subField['id'];
$body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = rgar( $entry, strval($fieldNumber) );
endforeach;
} } else {
$fieldNumber = $formField['id'];
$fieldLabel = dupeCheck($formField['label'], $body);
$body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = rgar( $entry, strval($fieldNumber) );
};
endforeach;
$body['form_source_url'] = $entry['source_url'];
$body['trackingid__sb'] = $_COOKIE['__ss_tk']; //DO NOT CHANGE THIS LINE... it collects the tracking cookie to establish tracking
$post_url = $base_uri . $post_endpoint;
if($sendToLeadGen) {
$request = new WP_Http();
$response = $request->post( $post_url, array( 'body' => $body ) );
}
if($testMode) {
$request2 = new WP_Http();
$response2 = $request2->post( $support_endpoint, array( 'body' => $body ) );

$request3 = new WP_Http();
$response3 = $request3->post( $support_endpoint, array( 'body' => $entry ) );

$request4 = new WP_Http();
$response4 = $request4->post( $support_endpoint, array( 'body' => $form ) );
}
}
