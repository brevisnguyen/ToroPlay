/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'tp-color-scheme' ),
		colorSchemeKeys = [
			'tp_color_a',
			'tp_color_b',
			'tp_color_c',
			'tp_color_d',
			'tp_color_e',
			'tp_color_f'
		],
		colorSettings = [
			'tp_color_a',
			'tp_color_b',
			'tp_color_c',
            'tp_color_d',
            'tp_color_e',
            'tp_color_f'
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
                    
					api( 'tp_color_a' ).set( tpColorScheme[value].colors[0] );
					api.control( 'tp_color_a' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', tpColorScheme[value].colors[0] )
						.wpColorPicker( 'defaultColor', tpColorScheme[value].colors[0] );
                    
					api( 'tp_color_b' ).set( tpColorScheme[value].colors[1] );
					api.control( 'tp_color_b' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', tpColorScheme[value].colors[1] )
						.wpColorPicker( 'defaultColor', tpColorScheme[value].colors[1] );
                    
					api( 'tp_color_c' ).set( tpColorScheme[value].colors[2] );
					api.control( 'tp_color_c' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', tpColorScheme[value].colors[2] )
						.wpColorPicker( 'defaultColor', tpColorScheme[value].colors[2] );
                    
					api( 'tp_color_d' ).set( tpColorScheme[value].colors[3] );
					api.control( 'tp_color_d' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', tpColorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', tpColorScheme[value].colors[3] );
                    
					api( 'tp_color_e' ).set( tpColorScheme[value].colors[4] );
					api.control( 'tp_color_e' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', tpColorScheme[value].colors[4] )
						.wpColorPicker( 'defaultColor', tpColorScheme[value].colors[4] );
                    
					api( 'tp_color_f' ).set( tpColorScheme[value].colors[5] );
					api.control( 'tp_color_f' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', tpColorScheme[value].colors[5] )
						.wpColorPicker( 'defaultColor', tpColorScheme[value].colors[5] );

                    

				} );
			}
		}
        
        
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSchemeKeys, tpColorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});
        
        var trcolor_select = jQuery("select[data-customize-setting-link='color_scheme'] option:selected").val();
		
        css = cssTemplate( colors );

		api.previewer.send( 'update-color-scheme-css', css );
        
        
	}

	// Update the CSS whenever a color setting is changed.
    
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
            
		} );
	} );
    
} )( wp.customize );