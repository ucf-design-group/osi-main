<?php

/* Template Name: Podcasters Application */

get_header();?>

<body>

	<section class= "content">

		<article class="form" id="form">

			<h2>Application</h2>

			<h4>Please add your kermits.</h4>

			<form class="form-wrapper" action='' method='POST' id='podcasters-form'>

				<fieldset>
					<p>
						<label for='podcasters-form-fname'>First Name</label>
						<br>
						<input type="text" name="podcasters-form-fname" value="">
					</p>
					<p>
						<label for='podcasters-form-lname'>Last Name</label>
						<br>
						<input type="text" name="podcasters-form-lname" value="">
					</p>
					<p>
						<label for='podcasters-form-major'>Major</label>
						<br>
						<input type="text" name="podcasters-form-major" value="">
					</p>
					<p>
						<label for='podcasters-form-year'>Year</label>
						<br>
						<input type="text" name="podcasters-form-year" value="">
					</p>
					<p>
						<label for='podcasters-form-gpa'>GPA</label>
						<br>
						<input type="text" name="podcasters-form-gpa" value="">
					</p>
				</fieldset>
				<fieldset>
					<p>
						<label for='podcasters-form-number'>Number of Podcasts</label>
						<br>
						<small>How many podcasts you think you will create.</small>
						<br>
						<input type="text" name="podcasters-form-number" value="">
					</p>
					<p>
						<label for='podcasters-form-frequency'>Frequency of Podcasts</label>
						<br>
						<small>How often you think you'll be uploading podcasts</small>
						<small><i>How often you think you'll be uploading podcasts</i></small>
						<br>
						<input type="text" name="podcasters-form-frequency" value="">
					</p>
					<p>
						<label for='podcasters-form-length'>Length of Podcasts</label>
						<br>
						<small>How long you think each podcast will be.</small>
						<br>
						<input type="text" name="podcasters-form-length" value="">
					</p>
					<p>
						<label for='podcasters-form-description'>Podcasts Description</label>
						<br>
						<textarea rows="4" cols="50" type="text" name="podcasters-form-description" value="">Please add a description of your podcast here.</textarea>
					</p>
				</fieldset>
				<p class='submit'>
					<input class='button' name='podcasters-form-submit' type='submit' value='Submit'>
				</p>
			</form>

		</article>

	</section>

</body>

<?php get_footer(); ?>