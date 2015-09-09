<?php
/* Template Name: Contact Us */

get_header();

include(get_stylesheet_directory_uri() . 'functions/inquiry-handler.php');?>


			
				<div class="content-area">
					<div class="main"> 
						<?php
						while (have_posts()) {
							the_post();
							get_template_part( 'content', 'page' );
						} ?>
					</div>

<?php
						if ($reply) {
?>
						<p class="alert"><?php echo $reply; ?></p>
<?php
						}
?>

						<section class="general">
							<h2>Contact OSI</h2>
							<h3 class="phone">Phone: </h3><p><a href="tel:407-823-6471">(407) 823-6471</a></p>
							<h3 class="fax">Fax: </h3><p><a href="tel:407-823-5899">(407) 823-5899</a></p>
							<h3 class="email">E-Mail: </h3><p><a href="mailto:osi@ucf.edu">osi@ucf.edu</a></p>
							<h3 class="location">Location: </h3><p>University of Central Florida<br>12715 Pegasus Dr.<br>Student Union, Room 208<br>Orlando, FL 32816</p>
							<h3 class="hours">Hours: </h3><p>Monday - Thursday (8am - 5pm)<br>Friday (8am - 5pm)<br>Saturday and Sunday (Closed)</p>
						</section>
							
						<section class= "other-inquiries">
							<h2>Have a Question?</h2>
							<h3>OSI Assist</h3>
							<p>For students who need accommodations (such as translators, etc.) please visit <!--<a href="<?php get_site_url() ?>/osi-assist">--><a href="https://ucf.collegiatelink.net/form/start/80396">Osi Assist</a> or call <a href="tel:407-823-6471">(407) 823-6471</a>.</p>
							<h3>OSI Events</h3>
							<p>Looking for information on an Agency-organized event?  Check out the website of the Agency putting on the event (the agencies are listed above).</p>
							<h3>Registered Student Organizations (RSO<sub>s</sub>)</h3>
							<p>Need more information about Student Organizations?  Check out the Student Orgs page (see above) or the <a href="<?php get_site_url() ?>/kort/">Knights of the RoundTable website</a>.</p>
						</section>

						<!--<section class="inquiries-form">
							<form id="inquiries-form" action="" method="post">
								<h2>General Inquiries</h2>

								<p>
									<label for="inquiries-form-name">Name:</label><br>
									<input type="text" name="inquiries-form-name" id="inquiries-form-name">
								</p>
								<p>
									<label for="inquiries-form-email">E-Mail:</label><br>
									<input type="email" name="inquiries-form-email" id="inquiries-form-email">
								</p>
								<p>
									<label for="inquiries-form-phone">Phone:</label><br>
									<input type="tel" name="inquiries-form-phone" id="inquiries-form-phone">
								</p>
								<p>
									<label for="inquiries-form-desc">Please describe your inquiry:</label><br>
									<textarea rows="4" cols="50" name="inquiries-form-desc" id="inquiries-form-desc"></textarea>
								</p>
								
								<?php include($_SERVER['DOCUMENT_ROOT'] . "/resources/recaptcha/recaptchalib.php"); ?>
								<?php include($_SERVER['DOCUMENT_ROOT'] . "/resources/secrets.php"); ?>
								<p><?php echo recaptcha_get_html($secrets['recaptcha_public'], $error); ?></p>

								<input type="submit" value="Submit">
								<input type="reset" value="Reset">
							</form>
						</section>-->

						<h2>General Inquiries</h2>
						<a href="https://ucf.collegiatelink.net/form/start/80396" target="_blank" class="button getinvolved">Contact Form</a>

				</div>

<?php get_footer(); ?>