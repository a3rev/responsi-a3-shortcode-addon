<?php
/**
 * Class SampleTest
 *
 * @package Sample_Plugin
 */

/**
 * Sample test case.
 */
class a3Rev_Tests_Sample extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */

	function test_responsi_theme() {
		$output = 1;

		$this->assertTrue( defined( 'RESPONSI_FRAMEWORK_VERSION' ) );
	}

	function test_sample() {
		$output = 1;

		$this->assertEquals( 1 , $output );
	}

	function test_responsi_css() {

		global $responsi_a3_shortcode_addon;
		$output = (string)$responsi_a3_shortcode_addon->responsi_build_dynamic_css();
		$this->assertStringContainsString( '.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2' , $output );

	}

	function test_responsi_shortcode() {

		global $responsi_a3_shortcode_addon;
		$output = do_shortcode('[a3_button]');
		$this->assertStringContainsString( '<a' , $output );

	}

}
