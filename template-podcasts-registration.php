<?php

/* Template Name: Podcasts Registration */

get_header();?>

<body>

	<section class= "content">

		<article class="form" id="form">

			<h2>Application</h2>

			<h4>Please add your kermits.</h4>

			<form class="form-wrapper" action='' method='POST' id='podcasts-form'>

				<fieldset>
					<p>
						<label for='podcasts-form-fname'>First Name</label>
						<br>
						<input type="text" name="podcasts-form-fname" value="">
					</p>
					<p>
						<label for='podcasts-form-lname'>Last Name</label>
						<br>
						<input type="text" name="podcasts-form-lname" value="">
					</p>
					<p>
						<label for='podcasts-form-major'>Major</label>
						<br>
						<input type="text" name="podcasts-form-major" value="">
					</p>
					<p>
						<label for='podcasts-form-year'>Year</label>
						<br>
						<input type="text" name="podcasts-form-year" value="">
					</p>
					<p>
						<label for='podcasts-form-gpa'>GPA</label>
						<br>
						<input type="text" name="podcasts-form-gpa" value="">
					</p>
				</fieldset>
				<fieldset>
					<p>
						<label for='podcasts-form-number'>Number of Podcasts</label>
						<br>
						<input type="text" name="podcasts-form-number" value="">
					</p>
					<p>
						<label for='podcats-form-frequency'>Frequency of Podcast</label>
						<br>
						<input type="text" name="podcats-form-frequency" value="">
					</p>
					<p>
						<label for='podcasts-form-length'>Length of Podcast</label>
						<br>
						<input type="text" name="podcasts-form-length" value="">
					</p>
					<p>
						<label for='podcasts-form-description'>Podcast Description</label>
						<br>
						<textarea rows="4" cols="50" type="text" name="podcasts-form-description" value="">Please add a description of your podcast here.</textarea>
					</p>
				</fieldset>
				<p class='submit'>
					<input class='button' name='podcasts-form-submit' type='submit' value='Submit'>
				</p>
			</form>

		</article>

	</section>

</body>

<?php get_footer(); ?>