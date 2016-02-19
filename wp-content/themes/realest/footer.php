<?php
//gets wp_footer hook
//includes script that are enqueue in footer
?>
<section class="last-section container-fluid">
	<footer id="footer-text" class="pull-right">
		Copyrights © 2015 Whitney Adams. All Rights Reserved.		
	</footer>
</section>
<?php do_action('before_body_end'); ?>
<?php wp_footer(); ?>
</body>
<?php do_action('after_body_end'); ?>
</html>