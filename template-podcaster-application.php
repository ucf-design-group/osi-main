<?php

/* Template Name: Podcaster Registration Form */

get_header();
include(locate_template('partials/single-podcaster-application-handler.php'));
?>

<body>

	<section class= "content">
		
		<small class="error">
<?php       
	        /* Start printing error information */
	    	echo $errorString;
			/* End printing error message*/
?>
		</small>

		<article class="form" id="form">

			<h2>Podcaster Application</h2>

			<h4>Apply to become a podcaster here! Your podcasts will be featured here on the OSI site where anyone can access them! We are your new podcast hosting site! .</h4>

			<form class="form-wrapper" action='' method='POST' id='podcaster-application-form'>

				<fieldset>
					<p>
						<label for='podcaster-application-form-fname'>First Name</label>
						<br>
						<input type="text" name="podcaster-application-form-fname" value="">
					</p>
					<p>
						<label for='podcaster-application-form-lname'>Last Name</label>
						<br>
						<input type="text" name="podcaster-application-form-lname" value="">
					</p>
					<p>
						<label for='podcaster-application-form-ucfid'>UCF ID</label>
						<br>
						<input type="text" name="podcaster-application-form-lname" value="">
					</p>
					<p>
						<label for='podcaster-application-form-major'>Major</label>
						<br>
						<input type="text" name="podcaster-application-form-major" value="">
					</p>
					<p>
						<label for='podcaster-application-form-year'>Year</label>
						<br>
						<select name="podcaster-application-form-year">
							<option value="Freshman">Freshman</option>
							<option value="Sophomore">Sophomore</option>
							<option value="Junior">Junior</option>
							<option value="Senior+">Senior+</option>
							<option value="Graduate">Graduate</option>
						</select>
					</p>
					<p>
						<label for='podcaster-application-form-gpa'>GPA</label>
						<br>
						<input type="text" name="podcaster-application-form-gpa" value="">
					</p>
				</fieldset>
				<fieldset>
					<p>
						<label for='podcaster-application-form-num-podcasts'>Number of Podcasts</label>
						<br>
						<small>How many podcasts you think you will create.</small>
						<br>
						<input type="text" name="podcaster-application-form-num-podcasts" value="">
						<select name="podcaster-application-form-num-podcasts">
							<option value="1-5">1-5</option>
							<option value="6-15">6-15</option>
							<option value="16-25">16-25</option>
							<option value="26+">26+</option>
						</select>
					</p>
					<p>
						<label for='podcaster-application-form-frequency'>Frequency of Podcasts</label>
						<br>
						<small>How often you think you'll be uploading podcasts</small>
						<small><i>How often you think you'll be uploading podcasts</i></small>
						<br>
						<select name="podcaster-application-form-frequency">
							<option value="1-2">(1-2)/month</option>
							<option value="3-10">(3-10)/month</option>
							<option value="11+">(10+)/month</option>
						</select>
					</p>
					<p>
						<label for='podcaster-application-form-podcast-length'>Length of Podcasts</label>
						<br>
						<small>How long you think each podcast will be.</small>
						<br>
						<input type="text" name="podcaster-application-form-podcast-length" value="">
						<select name="podcaster-application-form-podcasts-length">
							<option value="1-2">1-2 minutes</option>
							<option value="3-10">3-10 minutes</option>
							<option value="11-20">11-20 mintes</option>
							<option value="21+">21 mintes</option>
						</select>
					</p>
					<p>
						<label for='podcaster-application-form-podcast-description'>Podcasts Description</label>
						<br>
						<textarea rows="4" cols="50" type="text" name="podcaster-application-form-podcast-description" value="">Please add a description of your podcast here.</textarea>
					</p>
				</fieldset>
				<p class='submit'>
					<input class='button' name='podcaster-application-form-submit' type='submit' value='Submit'>
				</p>
			</form>

		</article>

	</section>

</body>
<?php get_footer(); ?>