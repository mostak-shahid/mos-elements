<?php
function mos_elements_settings_init() {
	register_setting( 'mos_elements', 'mos_elements_options' );
	add_settings_section('mos_elements_section_top_nav', '', 'mos_elements_section_top_nav_cb', 'mos_elements');
	add_settings_section('mos_elements_section_dash_start', '', 'mos_elements_section_dash_start_cb', 'mos_elements');
	add_settings_section('mos_elements_section_dash_end', '', 'mos_elements_section_end_cb', 'mos_elements');
	
	add_settings_section('mos_elements_section_scripts_start', '', 'mos_elements_section_scripts_start_cb', 'mos_elements');
	add_settings_field( 'field_jquery', __( 'JQuery', 'mos_elements' ), 'mos_elements_field_jquery_cb', 'mos_elements', 'mos_elements_section_scripts_start', [ 'label_for' => 'jquery', 'class' => 'mos_elements_row', 'mos_elements_custom_data' => 'custom', ] );
	add_settings_field( 'field_bootstrap', __( 'Bootstrap', 'mos_elements' ), 'mos_elements_field_bootstrap_cb', 'mos_elements', 'mos_elements_section_scripts_start', [ 'label_for' => 'bootstrap', 'class' => 'mos_elements_row', 'mos_elements_custom_data' => 'custom', ] );
	add_settings_field( 'field_css', __( 'Custom Css', 'mos_elements' ), 'mos_elements_field_css_cb', 'mos_elements', 'mos_elements_section_scripts_start', [ 'label_for' => 'mos_elements_css' ] );
	add_settings_field( 'field_js', __( 'Custom Js', 'mos_elements' ), 'mos_elements_field_js_cb', 'mos_elements', 'mos_elements_section_scripts_start', [ 'label_for' => 'mos_elements_js' ] );
	add_settings_section('mos_elements_section_scripts_end', '', 'mos_elements_section_end_cb', 'mos_elements');

}
add_action( 'admin_init', 'mos_elements_settings_init' );

function get_mos_elements_active_tab () {
	$output = array(
		'option_prefix' => admin_url() . "/options-general.php?page=mos_elements_settings&tab=",
		//'option_prefix' => "?post_type=p_file&page=mos_elements_settings&tab=",
	);
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif (isset($_COOKIE['plugin_active_tab'])) $active_tab = $_COOKIE['plugin_active_tab'];
	else $active_tab = 'dashboard';
	$output['active_tab'] = $active_tab;
	return $output;
}
function mos_elements_section_top_nav_cb( $args ) {
	$data = get_mos_elements_active_tab ();
	?>
    <ul class="nav nav-tabs">
        <li class="tab-nav <?php if($data['active_tab'] == 'dashboard') echo 'active';?>"><a data-id="dashboard" href="<?php echo $data['option_prefix'];?>dashboard">Dashboard</a></li>
        <li class="tab-nav <?php if($data['active_tab'] == 'scripts') echo 'active';?>"><a data-id="scripts" href="<?php echo $data['option_prefix'];?>scripts">Advanced CSS, JS</a></li>
    </ul>
	<?php
}
function mos_elements_section_dash_start_cb( $args ) {
	$data = get_mos_elements_active_tab ();
  $options = get_option( 'mos_elements_options' );
	?>
	<div id="mos-elements-dashboard" class="tab-con <?php if($data['active_tab'] == 'dashboard') echo 'active';?>">
		<?php var_dump($options) ?>

	<?php
}
function mos_elements_section_scripts_start_cb( $args ) {
	$data = get_mos_elements_active_tab ();
	?>
	<div id="mos-elements-scripts" class="tab-con <?php if($data['active_tab'] == 'scripts') echo 'active';?>">
	<?php
}
function mos_elements_field_jquery_cb( $args ) {
	$options = get_option( 'mos_elements_options' );
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mos_elements_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $options[ $args['label_for'] ] ) ? ( checked( $options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mos_elements' ); ?></label>
	<?php
}
function mos_elements_field_bootstrap_cb( $args ) {
	$options = get_option( 'mos_elements_options' );
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mos_elements_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $options[ $args['label_for'] ] ) ? ( checked( $options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mos_elements' ); ?></label>
	<?php
}
function mos_elements_field_css_cb( $args ) {
	$options = get_option( 'mos_elements_options' );
	?>
	<textarea name="mos_elements_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $options[ $args['label_for'] ] ) ? esc_html_e($options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_elements_css"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_elements_field_js_cb( $args ) {
	$options = get_option( 'mos_elements_options' );
	?>
	<textarea name="mos_elements_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $options[ $args['label_for'] ] ) ? esc_html_e($options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_elements_js"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_elements_section_end_cb( $args ) {
	$data = get_mos_elements_active_tab ();
	?>
	</div>
	<?php
}


function mos_elements_options_page() {
	//add_menu_page( 'WPOrg', 'WPOrg Options', 'manage_options', 'mos_elements', 'mos_elements_options_page_html' );
	add_submenu_page( 'options-general.php', 'Settings', 'Settings', 'manage_options', 'mos_elements_settings', 'mos_elements_admin_page' );
}
add_action( 'admin_menu', 'mos_elements_options_page' );

function mos_elements_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mos_elements_messages', 'mos_elements_message', __( 'Settings Saved', 'mos_elements' ), 'updated' );
	}
	settings_errors( 'mos_elements_messages' );
	?>
	<div class="wrap mos-elements-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		settings_fields( 'mos_elements' );
		do_settings_sections( 'mos_elements' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}