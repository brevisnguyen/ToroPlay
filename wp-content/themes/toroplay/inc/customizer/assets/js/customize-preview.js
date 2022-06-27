/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	var api = wp.customize;

	// Logo.
	api( 'tp_logo', function( value ) {
		value.bind( function( to ) {
            var original = $( ".custom-logo" ).data( "url" );
            if( to == '' ) {
                $('.custom-logo').attr('src', original);
            }else{
                $('.custom-logo').attr('src', to);
            }
		} );
	} );

} )( jQuery );