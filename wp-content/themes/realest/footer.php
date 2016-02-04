<?php
//gets wp_footer hook
//includes script that are enqueue in footer
?>

<?php do_action('before_body_end'); ?>
<?php wp_footer(); ?>
</body>
<?php do_action('after_body_end'); ?>
</html>