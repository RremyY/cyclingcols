<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="footerbutterfly"><p>duurzame ontwikkeling door techniekeducatie...</p></div>
	</footer><!-- #colophon -->
		
		<div id="grayblock">
		<?php
		get_sidebar( 'footer' );
		?>
		<div class="clear"></div>
		<div class="site-info"> 
			<p>Webdesign en realisatie door <a href="http://rmjg.nl" target="_blank">RMJG.nl</a> en <a href="http://www.ideeel.nl/" target="_blank">Ideeel</a>.</p>
		</div>
		
		</div>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>