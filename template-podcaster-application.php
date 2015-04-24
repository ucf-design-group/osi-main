<?php

/* Template Name: Podcaster Application */

get_header();
get_template_part('partials/podcaster-registration-handler')?>

<body>

	<section class= "content">

		<article class="form" id="form">

			<h2>Application</h2>

			<h4>Please add your kermits.</h4>

			<form class="form-wrapper" action='' method='POST' id='podcaster-registration-form'>

				<fieldset>
					<p>
						<label for='podcaster-form-fname'>First Name</label>
						<br>
						<br>
						<input type="text" name="podcaster-form-fname" value="">
					</p>
					<p>
						<label for='podcaster-form-lname'>Last Name</label>
						<br>
						<br>
						<input type="text" name="podcaster-form-lname" value="">
					</p>
					<p>
						<label for='podcaster-form-major'>Major</label>
						<br>
						<br>
						<input type="text" name="podcaster-form-major" value="">
					</p>
					<p>
						<label for='podcaster-form-year'>Year</label>
						<br>
						<select type="test" name="podcaster-form-year">
							<option value="">Select:</option>
							<option value="Freshman">Freshman</option>
							<option value="Sophomore">Sophomore</option>
							<option value="Junior">Junior</option>
							<option value="Senior">Sernior (or higher)</option>
						</select>
					</p>
					<p>
						<label for='podcaster-form-gpa'>GPA</label>
						<br>
						<input type="text" name="podcaster-form-gpa" value="">
					</p>
				</fieldset>
				<fieldset>
					<p>
						<label for='podcaster-form-num-podcasts'>Number of Podcasts</label>
						<br>
						<small>How many podcasts you think you will create.</small>
						<br>
						<select type="test" name="podcaster-form-year">
							<option value="">Select:</option>
							<option value="1-10">1-10</option>
							<option value="10-20">10-20</option>
							<option value="20-50">20-50</option>
							<option value="50+">50+</option>
						</select>
					</p>
					<p>
						<label for='podcaster-form-frequency'>Frequency of Podcasts</label>
						<br>
						<small>How often you think you'll be uploading podcasts</small>
						<small><i>How often you think you'll be uploading podcasts</i></small>
						<br>
						<select type="test" name="podcaster-form-frequency">
							<option value="">Select:</option>
							<option value="1">1/mo</option>
							<option value="2-5">2-5/mo</option>
							<option value="5-10">5-10/mo</option>
							<option value="10+">10+/mo</option>
						</select>
					</p>
					<p>
						<label for='podcaster-form-length'>Length of Podcasts</label>
						<br>
						<small>How long you think each podcast will be.</small>
						<br>
						<select type="test" name="podcaster-form-podcast-length">
							<option value="">Select:</option>
							<option value="5">Less than 5 mins</option>
							<option value="5-20">5-20 mins</option>
							<option value="20-45">20-45 mins</option>
							<option value="45+">45+ mins</option>
						</select>
					</p>
					<p>
						<label for='podcaster-form-podcast-description'>Podcasts Description</label>
						<br>
						<textarea rows="4" cols="50" type="text" name="podcaster-form-podcast-description" value="">Please add a description of your podcast here.</textarea>
					</p>
				</fieldset>
				<p class='submit'>
					<input class='button' name='podcaster-form-submit' type='submit' value='Submit'>
				</p>
			</form>

		</article>

	</section>

</body>

<?php get_footer(); ?>