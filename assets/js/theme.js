jQuery(function($) {
	$('.mobile-menu-toggle').click(function(){
		$('.mobile-menu').toggleClass('mobile-menu-active');
	});


	$( '.mobile-menu .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to sub menus


	$( '.sub-menu-toggle' ).on( 'click', function() {
			var $this = $( this );
			$this.attr( 'aria-pressed', function( index, value ) {
				return 'false' === value ? 'true' : 'false';
			});

			$this.toggleClass( 'activated' );
			$this.next( '.sub-menu' ).slideToggle( 'fast' );

		});
});