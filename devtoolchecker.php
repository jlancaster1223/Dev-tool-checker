<?php

/*
Plugin Name:  Dev tool checker
Plugin URI:   https://jameslancaster.co.uk
Description:  Checks if the user of the site has any developer tools open and what orientation that it is in.
Version:      v1.0.1
Author:       James Lancaster
Author URI:   https://jameslancaster.co.uk
*/




/* Dev tool checker */
function devtoolchecker() {
?>
<script>(function(){'use strict';const devtools={isOpen:false,orientation:undefined};const threshold=160;const emitEvent=(isOpen,orientation)=>{window.dispatchEvent(new CustomEvent('devtoolschange',{detail:{isOpen,orientation}}));};const main=({emitEvents=true}={})=>{const widthThreshold=window.outerWidth-window.innerWidth>threshold;const heightThreshold=window.outerHeight-window.innerHeight>threshold;const orientation=widthThreshold?'vertical':'horizontal';if(!(heightThreshold&&widthThreshold)&&((window.Firebug&&window.Firebug.chrome&&window.Firebug.chrome.isInitialized)||widthThreshold||heightThreshold)){if((!devtools.isOpen||devtools.orientation!==orientation)&&emitEvents){emitEvent(true,orientation);}
devtools.isOpen=true;devtools.orientation=orientation;}else{if(devtools.isOpen&&emitEvents){emitEvent(false,undefined);}
devtools.isOpen=false;devtools.orientation=undefined;}};main({emitEvents:false});setInterval(main,500);if(typeof module!=='undefined'&&module.exports){module.exports=devtools;}else{window.devtools=devtools;}})();</script>
<script type="module">
	// Check if it's open
	console.log('Is DevTools open:', window.devtools.isOpen);

	// Check it's orientation, `undefined` if not open
	console.log('DevTools orientation:', window.devtools.orientation);

	// Get notified when it's opened/closed or orientation changes
	window.addEventListener('devtoolschange', event => {
		console.log('Is DevTools open:', event.detail.isOpen);
		console.log('DevTools orientation:', event.detail.orientation);
	});
	
	var toolchecker = window.devtools.isOpen;
	
	if (toolchecker == true) {
		jQuery('.x-root').addClass('devtoolsopen');	
	};
</script>
<?php 
};
add_action( 'wp_footer', 'devtoolchecker');

?>
