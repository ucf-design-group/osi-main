<?php

/* Template Name: Podcaster Registration Form */

get_header();
include(locate_template('partials/single-podcaster-application-handler.php'));
?>

<body>

	<section class= "content">
		<article class="form" id="form">
			<div class="title-wrapper">
				<!-- Prints message according to form success/failure (handled in handler) -->
				<small style="font-style:italic; color:green;"><?php echo $successString ?></small> 
				<small style="font-style:italic; color:red;"><?php echo $errorString; ?></small>
				<br>
<?php if(!(sizeof($successString) > 1)) : ?>				
				<h2>Podcaster Application</h2>

				<h4>Apply to become a podcaster here! Your podcasts will be featured here on the OSI site where anyone can access them! We are your new podcast hosting site!</h4>
<?php endif; ?>
			</div>				
		<article class="form" id="form">
			<form class="form-wrapper" action='' method='POST' id='podcaster-application-form' style="min-height:500px">
<?php if(!(sizeof($successString) > 1)) : ?>
				<fieldset>
					<p>
						<label for='podcaster-application-form-fname'>First Name</label>
						<br>
						<input type="text" name="podcaster-application-form-fname" value="<?php if($fname) echo $fname; ?>">
					</p>
					<p>
						<label for='podcaster-application-form-lname'>Last Name</label>
						<br>
						<input type="text" name="podcaster-application-form-lname" value="<?php if($lname) echo $lname; ?>">
					</p>
					<p>
						<label for='podcaster-application-form-ucfid'>UCF ID</label>
						<br>
						<small>Your PID without the first letter</small>
						<br>
						<input type="text" name="podcaster-application-form-ucfid" value="<?php if($ucfid) echo $ucfid; ?>">
					</p>
					<p>
						<label for='podcaster-application-form-major'>Major</label>
						<br>
						<input type="text" name="podcaster-application-form-major" value="<?php if($major) echo $major; ?>">
					</p>
					<p>
						<label for='podcaster-application-form-year'>Year</label>
						<br>
						<select name="podcaster-application-form-year">
							<option value="">Select:</option>
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
						<input type="text" name="podcaster-application-form-gpa" value="<?php if($gpa) echo $gpa; ?>">
					</p>
				</fieldset>
				<fieldset>
					<p>
						<label for='podcaster-application-form-num-podcasts'>Number of Podcasts</label>
						<br>
						<small>How many podcasts you think you will create.</small>
						<br>
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
							<option value="">Select:</option>
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
						<textarea rows="4" cols="50" type="text" name="podcaster-application-form-podcast-description" value="<?php if($description) echo $description; ?>"><?php if($description) echo $description; ?></textarea>
					</p>
				</fieldset>
				<p class='submit'>
					<input class='button' name='podcaster-application-form-submit' type='submit' value='Submit'>
				</p>
<?php endif; ?>
			</form>
		</article>

	</section>

</body>
<?php get_footer(); ?>