<?php
class Shortcode_Columns_Class {

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		new Shortcode_Columns_FiveSixth();
		new Shortcode_Columns_FourFifth();
		new Shortcode_Columns_OneFifth();
		new Shortcode_Columns_OneFourth();
		new Shortcode_Columns_OneHalf();
		new Shortcode_Columns_OneSixth();
		new Shortcode_Columns_OneThird();
		new Shortcode_Columns_ThreeFifth();
		new Shortcode_Columns_ThreeFourth();
		new Shortcode_Columns_TwoFifth();
		new Shortcode_Columns_TwoThird();
	}
}
$GLOBALS['Shortcode_Columns_Class'] = new Shortcode_Columns_Class();
?>
