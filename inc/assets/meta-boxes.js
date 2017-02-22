jQuery( function ( $ ) {
	/**
	 * Show, hide a <div> based on a checkbox
	 *
	 * @since Easy Websites Maker 1.0
	 */
	function checkboxToggle() {
		$( 'body' ).on( 'change', '.checkbox-toggle input', function() {
			var $this = $( this ),
				$toggle = $this.closest( '.checkbox-toggle' ),
				action;
			if ( !$toggle.hasClass( 'reverse' ) )
				action = $this.is( ':checked' ) ? 'slideDown' : 'slideUp';
			else
				action = $this.is( ':checked' ) ? 'slideUp' : 'slideDown';

			$toggle.next()[action]();
		} );
		$( '.checkbox-toggle input' ).trigger( 'change' );
	}

	/**
	 * Show, hide post format meta boxes
	 *
	 * @since Easy Websites Maker 1.0
	 */
	function togglePostFormatMetaBoxes() {
		var $input = $( 'input[name=post_format]' ),
			$metaBoxes = $( '[id^="ewm-meta-box-post-format-"]' ).hide();

		// Don't show post format meta boxes for portfolio
		if ( $( '#post_type' ).val() == 'portfolio' )
			return;

		$input.change( function () {
			$metaBoxes.hide();
			$( '#ewm-meta-box-post-format-' + $( this ).val() ).show();
		} );
		$input.filter( ':checked' ).trigger( 'change' );
	}

	/**
	 * Show contact meta box for contact page template only
	 *
	 * @since Easy Websites Maker 1.0
	 */
	function toggleContactSettings() {
		$( '#page_template' ).change(function () {
			$( '#ewm-meta-box-contact' )[$( this ).val() == 'tpl/contact.php' ? 'show' : 'hide']();
		} ).trigger( 'change' );
	}

	checkboxToggle();
	togglePostFormatMetaBoxes();
	toggleContactSettings();
} );