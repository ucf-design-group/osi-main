<?php

/* Template Name: OSI Assist */


get_header(); ?>

					<div class="content-area">
						<div class="main"> 
							<?php
							while (have_posts()) {
								the_post();
								get_template_part( 'content', 'page' );
							} ?>
						</div>

						<section class="inquiries-form">
							<form id="assist-form" action="" method="post">
								<h2>OSI Assist Interpreter Request</h2>
								<fieldset>
									<legend>General Event Info</legend>
									<p>
										<label for="assist-form-eventname">Event Name:</label><br>
										<input type="text" name="assist-form-eventname" id="assist-form-eventname">
									</p>
									<p>
										<label for="assist-form-location">Location:</label><br>
										<input type="text" name="assist-form-location" id="assist-form-location">
									</p>
									<p>
										<label for="assist-form-attendees">Number of Attendees:</label><br>
										<input type="text" name="assist-form-attendees" id="assist-form-attendees">
									</p>
									<p>
										<label for="assist-form-startdate">Event Start:</label><br>
										<table>
											<tr>
												<td><input type="text" name="assist-form-startdate" id="assist-form-startdate" onchange='startDateCheck()'></td>
												<td><input type="text" name="assist-form-starttime" id="assist-form-starttime" onchange='startTimeCheck()'></td>
												<td>
													<select name='assist-form-startampm' id='assist-form-startampm'>
														<option value='am'>am</option>
														<option value='pm' selected>pm</option>
													</select>
												</td>
											</tr>
										</table>
									</p>
									<p>
										<label for="assist-form-enddate">Event End:</label><br>
										<table>
											<tr>
												<td><input type="text" name="assist-form-enddate" id="assist-form-enddate" onchange='endDateCheck()'></td>
												<td><input type="text" name="assist-form-endtime" id="assist-form-endtime"></td>
												<td>
													<select name='assist-form-endampm' id='assist-form-endampm'>
														<option value='am'>am</option>
														<option value='pm' selected>pm</option>
													</select>
												</td>
											</tr>
										</table>
									</p>
								</fieldset>

								<fieldset class="eventHostInfo">
									<legend>Event Host Info</legend>
									<p>
										<label for="assist-form-eventhost">Event Host: (Agency / Org)</label><br>
										<input type="text" name="assist-form-eventhost" id="assist-form-eventhost">
									</p>
									<p>
										<label for="assist-form-contactname">Host Contact Name:</label><br>
										<input type="text" name="assist-form-contactname" id="assist-form-contactname">
									</p>
									<p>
										<label for="assist-form-contactphone">Host Contact Phone:</label><br>
										<input type="tel" name="assist-form-contactphone" id="assist-form-contactphone">
									</p>
									<p>
										<label for="assist-form-contactemail">Host Contact Email:</label><br>
										<input type="email" name="assist-form-contactemail" id="assist-form-contactemail">
									</p>
								</fieldset>

								<fieldset class="additionalInfo">
									<legend>Additional Info</legend>
									<p>
										<label for="assist-form-comments">Any other special circumstances or requests:</label><br>
										<textarea name="assist-form-comments" id="assist-form-comments"></textarea>
									</p>
									<p>
										<label for="assist-form-submitteremail">Requesters Email:</label><br>
										<input type="email" name="assist-form-submitteremail" id="assist-form-submitteremail" value=" ">
									</p>
								</fieldset>
								<fieldset class="submitArea">
									<p>Where appropriate, interpreters/captionists may need a copy of agenda, presentations, or other information prior to the event in order to prepare. Please send as .pdf or .doc attachment to BOTH <a href="mailto:osiassist@ucf.edu">osiassist@ucf.edu</a> and <a href="mailto:dhhservices@ucf.edu">dhhservices@ucf.edu.</a></p>
									<input type="submit" name="submit" value="Submit">
									<input type="reset" value="Reset">
								</fieldset>
							</form>
						</section>
					</div>
<?php get_footer(); ?>
