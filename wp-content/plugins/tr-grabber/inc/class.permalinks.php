<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class trgrabber_permalinks {
	public function __construct() {
		add_action('admin_init', array( $this, 'settingsInit'));
		add_action('admin_init', array( $this, 'settingsSave'));
	}

	/* Fields
	-------------------------------------------------------------------------------
	*/
	public function settingsInit() {
		$this->addField('', array($this, 'tr_grabber_permalink_title'));
		$this->addField('tr_movies_permalink', array( $this, 'tr_movies_permalink'), __('Movies', 'tr-grabber') );
		$this->addField('tr_series_permalink', array( $this, 'tr_series_permalink'), __('Series', 'tr-grabber') );
		$this->addField('tr_season_permalink', array( $this, 'tr_season_permalink'), __('Season', 'tr-grabber') );
		$this->addField('tr_episode_permalink', array( $this, 'tr_episode_permalink'), __('Episode', 'tr-grabber') );
		$this->addField('tr_letter_permalink', array( $this, 'tr_letter_permalink'), __('Letters', 'tr-grabber') );
		$this->addField('tr_cast_permalink', array( $this, 'tr_cast_permalink'), __('Cast', 'tr-grabber') );
		$this->addField('tr_casttv_permalink', array( $this, 'tr_casttv_permalink'), __('Cast TV', 'tr-grabber') );
		$this->addField('tr_director_permalink', array( $this, 'tr_director_permalink'), __('Director', 'tr-grabber') );
		$this->addField('tr_directortv_permalink', array( $this, 'tr_directortv_permalink'), __('Director TV', 'tr-grabber') );
	}

	/* Callbacks
	-------------------------------------------------------------------------------
	*/
	public function tr_grabber_permalink_title() {
		echo '<h2 class="title">'. __('TR Grabber - Permalink Settings') .'</h2>';
	}
	
	public function tr_movies_permalink() {
        global $config_grabber;
		echo $this->input('slug_movies', $config_grabber['slug_movies'], '/name/');
	}
    
	public function tr_series_permalink() {
        global $config_grabber;
		echo $this->input('slug_series', $config_grabber['slug_series'], '/name/');
	}
    
	public function tr_season_permalink() {
        global $config_grabber;
		echo $this->input('prefix_season', $config_grabber['slug_season'], '/name/');
	}
    
	public function tr_episode_permalink() {
        global $config_grabber;
		echo $this->input('prefix_episode', $config_grabber['slug_episode'], '/name/');
	}
    
	public function tr_letter_permalink() {
        global $config_grabber;
		echo $this->input('slug_letters', $config_grabber['slug_letters'], '/a/');
	}
    
	public function tr_cast_permalink() {
        global $config_grabber;
		echo $this->input('prefix_cast', $config_grabber['prefix_cast'], '/name/');
	}
    
	public function tr_casttv_permalink() {
        global $config_grabber;
		echo $this->input('prefix_casttv', $config_grabber['prefix_casttv'], '/name/');
	}
    
	public function tr_director_permalink() {
        global $config_grabber;
		echo $this->input('prefix_director', $config_grabber['prefix_director'], '/name/');
	}
    
	public function tr_directortv_permalink() {
        global $config_grabber;
		echo $this->input('prefix_directortv', $config_grabber['prefix_directortv'], '/name/');
	}

	/* Save settings
	-------------------------------------------------------------------------------
	*/
	public function settingsSave() {
		if ( ! is_admin() ) return;
		$this->saveField('slug_movies');
		$this->saveField('slug_series');
		$this->saveField('prefix_season');
		$this->saveField('prefix_episode');
		$this->saveField('slug_letters');
		$this->saveField('prefix_cast');
		$this->saveField('prefix_casttv');
		$this->saveField('prefix_director');
		$this->saveField('prefix_directortv');
	}

	/*Helpers
	-------------------------------------------------------------------------------
	*/
	public function input( $option_name, $placeholder = '', $type = NULL, $ul = NULL ) {
        global $config_grabber;

		$slug = isset($config_grabber[$option_name]) ? $config_grabber[$option_name] : '';
		$value = ( isset( $slug ) ) ? esc_attr( $slug ) : '';
        $type = ($type) ? '<code>'. $type .'</code>' : null;
        
		return '<code>'. home_url() .'/</code><input name="'. $option_name .'" type="text" class="regular-text code" value="'. $slug .'" placeholder="'. $placeholder .'" />'.$type;
	}
	public function addField( $option_name, $callback, $title = NULL ){
		add_settings_field(
			$option_name, // id
			$title,       // setting title
			$callback,    // display callback
			'permalink',  // settings page
			'optional'    // settings section
		);
	}
	public function saveField( $option_name ){
        global $config_grabber;
        
        if ( isset( $_POST[$option_name] ) ) {
            
			$permalink_structure = ( $_POST[$option_name] );
			$permalink_structure = untrailingslashit( $permalink_structure );
                        
            $config_grabber[$option_name] = $permalink_structure;
		                        
		}
        update_option( 'tr_grabber', serialize( $config_grabber ) );
	}
}
new trgrabber_permalinks;

?>