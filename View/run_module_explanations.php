	<h5>Explanations for the modules</h5>
	<div class="panel-group" id="explanation_accordion">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#knitr">
					<i class="fa-fw fa fa-bar-chart-o"></i> Markdown &amp; Knitr <br><small>formatting, personalising, plotting feedback</small>
				</a>
			</div>
			<div id="knitr" class="panel-collapse collapse in survey">
				<div class="panel-body">
				  <h5>Markdown</h5>
				  <p>
	 	 			 <i class="fa fa-bar-chart-o fa-huge fa-fw pull-right"></i>
		  
					You can format text/feedback everywhere (i.e. item labels, choice labels, the feedback	 shown in Pause, on Stop, in emails) in a natural fashion using <a href="http://daringfireball.net/projects/markdown/syntax" title="Go to this link for a more exhaustive guide">Github-flavoured Markdown</a>.<br>
					The philosophy is that you should simply write like you would in a plain-text email and Markdown turns it nice.
				</p>
				<p>
<pre>* list item 1
* list item 2</pre> will turn into a nice bulleted list. <code># </code> at the beginning of a line turns it into a large headline, <code>## </code> up to <code>###### </code> turn it into smaller ones.
					 <code>*<em>italics</em>* and __<strong>bold</strong>__</code> are also easy to do, as are 
					 <code>[<a href="http://yihui.name/knitr/">links</a>](http://yihui.name/knitr/)</code> and embedded images <code>![image description](http://imgur.com/imagelink)</code>. You can quote something by placing a &gt; at the beginning of the line. If you you want to use the literal character (for e.g. saying &gt; (greater than) 18), you'll need to escape it like this <code>\&gt;</code>
		 		</p>
				<p>
					If you're already familiar with <a href="https://en.wikipedia.org/wiki/HTML"><abbr title="Hypertext Markup Language">HTML</abbr></a> you can also use that instead, though it is a little less readable for humans. Or mix it with Markdown! You may for example use it to go beyond Markdown's features and e.g. add icons to your text using <code>&lt;i class=&quot;fa fa-2x fa-smile-o&quot;&gt;&lt;/i&gt;</code> to get a smilie for instance. Check the full set of available icons at <a href="http://fontawesome.io/icons/">Font Awesome</a>. 
				</p>
					  <h5>Knitr</h5>
		   		<p>
					If you want to customise the text or generate custom feedback, including plots, you can use <a href="http://yihui.name/knitr/">Knitr</a>. Thanks to Knitr you can freely mix Markdown and chunks of R. Some examples:
				</p>
				<ul class="fa-ul">
					<li>
						<i class="fa-li fa fa-calendar"></i>
						<code>Today is `r date()`</code> shows today's date.<br>
					</li>
					<li>
						<i class="fa-li fa fa-user"></i>
						<code>Hello `r demographics$name`</code> greets someone using the variable "name" from the survey "demographics".<br>
					</li>
					<li>
						<i class="fa-li fa fa-user"></i>
						<code>Dear `r ifelse(demographics$sex == 1, 'Sir', 'Madam')`</code> greets someone differently based on the variable "sex" from the survey "demographics".<br>
					</li>
					<li>
						<i class="fa-li fa fa-bar-chart-o"></i>
						You can also plot someone's extraversion on the standard normal distribution.
	<pre><code class="r">library(formr)
# build scales automatically
big5 = formr_aggregate(results = big5)
# standardise
big5$extraversion = scale(big5$extraversion, center = 3.2, scale = 2.1)

# plot
qplot_on_normal(big$extraversion, xlab = "Extraversion")
</code></pre><br>
yields<br>
<img src="<?=WEBROOT?>assets/img/examples/example_fb_plot.png" width="330" height="313">
					</li>
		   		</p>

			</div>
		</div>
	</div>
		
	

		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#survey">
					<i class="fa-fw fa fa-pencil-square"></i> Survey <br><small>ask questions, get data</small>
				</a>
			</div>
			<div id="survey" class="panel-collapse collapse survey">
				<div class="panel-body">
					<p>
						 <i class="fa fa-pencil-square fa-huge fa-fw pull-right"></i>
		  
						  Surveys are series of questions that are created using simple spreadsheets/<strong>item tables</strong> (eg. Excel).</p>

					<p>You can add the same survey to a run several times or even loop them using Skip Backward.<br>
					You can also use the same survey across different runs. For example this would allow you to ask respondents for their demographic information only once. You'd do this by using a Skip Forward with the condition <code>nrow(demographics) &gt; 0</code> and skipping over the demographics survey, if true.</p>
				</div>
			</div>
		</div>
	
	
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#external">
					<i class="fa-fw fa fa-external-link-square"></i> External link <br><small>use modules outside formr</small>
				</a>
			</div>
			<div id="external" class="panel-collapse collapse external">
						<div class="panel-body">
					  <p>
			 			 <i class="fa fa-external-link-square fa-huge fa-fw pull-right"></i>
			  
						  These are external links - use them to send users to other, specialised data collection modules, such as a social network generator, a reaction time task, anything really. 
					  </p>
						  <p>
							  If you insert the placeholder <code>{{login_code}}</code>, it will be replaced by the user's run session code, allowing you to link data later (but only if your external module picks this variable up!). </p>
						  <p>
							  Sometimes, you may find yourself wanting to do more complicated stuff like <b>(a)</b> sending along more data, the user's age for example, <b>(b)</b> calling an <abbr class="initialism" title="Application programming interface.">API</abbr> to do some operations before the user is sent off (e.g. making sure the other end is ready to receive, this is useful if you plan to integrate formr tightly with some other software) <b>(c)</b> redirecting the user to a large number of custom links (e.g. you want to redirect users to the profile of the person who last commented on their Facebook wall to assess closeness) <b>(d)</b> you want to optionally redirect users back to the run (e.g. as a fallback or to do complicated stuff in formr). 
						  </p>
						  <p>
							  You can either choose to "finish/wrap up" this component <em>before</em> the user is redirected (the simple way) or enable your external module to call our <abbr class="initialism" title="Application programming interface.">API</abbr> to close it only once the external component is finished (the proper way). If you do the latter, the user will always be redirected to the external page until that page makes the call that the required input has been made.
					  </p>
			</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#email">
					<i class="fa-fw fa fa-envelope"></i> Email <br><small>invite, remind, send feedback</small>
				</a>
			</div>
			<div id="email" class="panel-collapse collapse email">
						<div class="panel-body">
		 			 <i class="fa fa-envelope fa-huge fa-fw pull-right"></i>
		  
					  <p>
						  Using an SMTP account (most email addresses come with one) that you can <a href="<?= WEBROOT ?>admin/mail/">set up in the mail section</a>, you can send email to your participants, their friends (or yourself). Using the tag <code>{{login_link}}</code>, you can send users a personalised link to the run. You can also use <code>{{login_code}}</code> to use the session code to create custom links, e.g. for inviting peers to rate this person (informants).
					  </p>
		 			 <h5><i class="fa fa-envelope"></i> Example 1: <small>email to participants or their friend</small></h5>
		 			 <p>
						 A simple one-shot survey with feedback. Let's say your run contains 
						 <ul class="fa-ul">
							 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 1. a survey called <strong>big5</strong> which assesses the big 5 personality traits and asks for the users email address (the field is called <code>email_address</code>).</li>
							 <li><i class="fa-li fa fa-envelope"></i> Pos. 2. an email with a feedback plot of the participant's big 5 scores. The recipient field contains <code>big5$email_address</code>.</li>
							 <li><i class="fa-li fa fa-stop"></i> Pos. 3. Displays the same feedback as in the email to the participants.</li>
						 </ul>
					 </p>
					 <h5>What would happen?</h5>
					 <p>A user fills out your survey. After completing it, they see the feedback page, which contains a bar chart of their individual big 5 scores. Before they see the page marked by the stop point, an email containing the very same feedback test (simply copy-pasted from below) is sent off to their email address - this way they get a take-home copy as well.</p>
				 
		 			 <h5><i class="fa fa-envelope"></i> Example 2: <small>email to yourself</small></h5>
		 			 <p>
						 A simple one-shot survey with feedback. Let's say your run contains 
						 <ul class="fa-ul">
							 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 1. a survey called <strong>big5</strong> as above.</li>
							 <li><i class="fa-li fa fa-envelope"></i> Pos. 2. an email with a feedback plot of the participant's big 5 scores. The recipient field contains <code>'youremailaddress@example.org'</code>. Note the single quotes, they mean that this is a constant.</li>
							 <li><i class="fa-li fa fa-stop"></i> Pos. 3. Display a thank you note.</li>
						 </ul>
					 </p>
					 <h5>What would happen?</h5>
					 <p>A user fills out your survey. After completing it, they see the thank you note at pos. 3. Before they see the page marked by the stop point, an email is sent off to <em>youremailaddress@example.org</em> - this way you could would an email notification for every notification. This might be helpful in longitudinal surveys where experimenter intervention is required to e.g. set up a phone interview.</p>
					  <p>
						  See the <a href="#knitr" data-toggle="tab">Knitr &amp; Markdown</a> section to find out how to generate personalised email, which contain feedback, including plots.
					  </p>
		  </div>
		  </div>
		</div>



	
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#skip_backward">
					<i class="fa-fw fa fa-backward"></i> Skip Backward <br><small>create loops</small>
				</a>
			</div>
		    <div id="skip_backward" class="panel-collapse collapse skip_backward">
				<div class="panel-body">
			 <p>
				 <i class="fa fa-backward fa-huge fa-fw pull-right"></i>
				 Skip backward allows you to jump back in the run, if a specific condition is fulfilled. <br>
				 This way, you can create a <strong>loop</strong>. Loops, especially in combination with reminder emails are useful for <strong>diary</strong>,<strong> training</strong>, and <strong>experience sampling</strong> studies. <br>
			 </p>
			 <h5><i class="fa fa-book"></i> Example 1:</h5>
			 <p>
				 A simple diary. Let's say your run contains 
				 <ul class="fa-ul">
					 <li><i class="fa-li fa fa-pause"></i> Pos. 1. a pause which always waits until 6PM</li>
					 <li><i class="fa-li fa fa-envelope"></i> Pos. 2. an email invitation</li>
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 3. a survey called <strong>diary</strong> containing your diary questions</li>
					 <li><i class="fa-li fa fa-backward"></i> Pos. 4. You would now add a Skip Backward with the following condition: <code>nrow(diary) &lt; 14</code> and the instructions to jump back to position 1, the pause, if that is true.</li>
					 <li><i class="fa-li fa fa-stop"></i> Pos. 5. At this position you could then use a Stop point, marking the end of your diary study.</li>
				 </ul>
				 <h5>What would happen?</h5>
				 <p>Starting at 1, users would receive their first invitation to the diary at 6PM the first day (in this scenario this would be their first contact with the run). After completion, the Skip Backward would send them back to the pause, where you could thank them for completing today's diary and instruct them to close their web browser. Automatically, once it is 6PM the next day, they would receive another invitation, complete another diary etc. Once this cycle repeated 14 times, the condition would no longer be true and they would progress to position 5, where they might receive feedback on their mood fluctuation in the diary. 
			 </p>
			 <h5><i class="fa fa-cloud"></i> Example 2:</h5>
			 <p>
				 But you can also make a loop that doesn't involve user action, to periodically check for external events:
				 <ul class="fa-ul">
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 1. a short survey called <strong>location</strong> that mostly just asks for the users' GPS coordinates</li>
					 <li><i class="fa-li fa fa-pause"></i> Pos. 2. a pause which always waits one day</li>
					 <li><i class="fa-li fa fa-backward"></i> Pos. 3. A Skip Backward checks which checks the weather at the user's GPS coordinates. If no thunderstorm occurred there, it jumps back to the pause at position 2. If a storm occurred, however, it progresses.</li>
					 <li><i class="fa-li fa fa-envelope"></i> Pos. 4. an email invitation</li>
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 4. a survey called <strong>storm_mood</strong> containing your questions regarding the user's experience of the storm.</li>
					 <li><i class="fa-li fa fa-stop"></i> Pos. 5. At this position you could then use a Stop point for a one-shot storm survey or you could again skip backward until at least 14 storms have been experienced per participant.</li>
				 </ul>
				 <h5>What would happen?</h5>
				 <p>In this scenario, the user takes part in the short survey first. We obtain the geolocation, which can be used to retrieve the local weather using API calls to weather information services in the Skip Backward at position 3. The weather gets checked once each day and if there ever is a thunderstorm, the user is invited via email to take a survey detailing their experience of the thunderstorm.  This way, the users only gets invited when necessary, we don't have to ask them to report weather events on a daily basis and risk driving them away.
			 </p>
		  </div>
		  </div>
	  </div>
  
  
  
	<div class="panel panel-default">
		<div class="panel-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#pause">
				<i class="fa-fw fa fa-pause"></i> Pause <br><small>delay continuation</small>
			</a>
		</div>
		<div id="pause" class="panel-collapse collapse pause">
					<div class="panel-body">
				  <p>
		 			 <i class="fa fa-pause fa-huge fa-fw pull-right"></i>
		  
					  This simple component allows you to delay the continuation of the run, be it<br>
					  until a certain date (01.01.2014 for research on new year's hangovers), <br>
					  time of day (asking participants to sum up their day in their diary after 7PM)<br>
					  or to wait relative to a date that a user specified (such as her graduation date or the last time he cut his nails).
				  </p>
				  <p>
					  See the <a href="#knitr" data-toggle="tab">Knitr &amp; Markdown</a> section to find out how to personalise the text shown while waiting.
				  </p>
		</div>
		</div>
	</div>
  
  
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#skip_forward">
					<i class="fa-fw fa fa-forward"></i> Skip Forward <br><small>filters/screenings, paths, reminders, access windows</small>
				</a>
			</div>
			<div id="skip_forward" class="panel-collapse collapse skip_forward">
				<div class="panel-body">
			 <p>
				 <i class="fa fa-forward fa-huge fa-fw pull-right"></i>
				 Skip forward allows you to jump forward in the run, if a specific condition is fulfilled. There are many simple but also complicated applications for this.
			 </p>
			 <h4><i class="fa fa-filter"></i> Example 1: <small>a filter/screening</small></h4>
			 <p>
				 Let's say your run contains 
				 <ul class="fa-ul">
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 1. a survey (depression) which has an item about suicidality</li>
					 <li><i class="fa-li fa fa-forward"></i> Pos. 2. a Skip Forward which checks <code>depression$suicidal != 1</code>. If the person is not suicidal, it skips forward to pos 4.</li>
					 <li><i class="fa-li fa fa-stop"></i> Pos. 3. At this position you would use a Stop point. Here you could give the user the numbers for suicide hotlines and tell them they're not eligible to participate.</li>
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 3. Here you could do your real survey.</li>
				 </ul>
				 <h5>What would happen?</h5>
				 <p>Starting at 1, users would complete a survey on depression. If they indicated suicidal tendencies, they would receive only the numbers for suicide hotlines at which point the run would end for them. If they did not indicate suicidal tendencies, they would be eligible to participate in the main survey.
			 </p>
			 <h4><i class="fa fa-random"></i> Example 2: <small>different paths</small></h4>
			 <p>
				 Let's say your run contains 
				 <ul class="fa-ul">
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 1. a survey on optimism (optimism)</li>
					 <li><i class="fa-li fa fa-forward"></i> Pos. 2. a Skip Forward which checks <code>optimism$pessimist == 1</code>. If the person is a pessimist, it skips forward to pos 5.</li>
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 3. a survey tailored to optimists</li>
					 <li><i class="fa-li fa fa-forward"></i> Pos. 4. a Skip Forward which checks <code>TRUE</code>, so it always skips forward to pos 6.</li>
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 5. a survey tailored to pessimists</li>
					 <li><i class="fa-li fa fa-stop"></i> Pos. 6. At this position you would thank both optimists and pessimists for their participation.</li>
				 </ul>
				 <h5>What would happen?</h5>
				 <p>Starting at 1, users would complete a survey on optimism. If they indicated that they are pessimists, they fill out a different survey than if they are optimists. Both groups receive the same feedback at the end. It is important to note that we have to let the optimists jump over the survey tailored to pessimists at position 4, so that they do not have to take both surveys.
			 </p>
			 <h4><i class="fa fa-clock-o"></i> Example 3: <small>reminders and access windows</small></h4>
			 <p>
				 Let's say your run contains 
				 <ul class="fa-ul">
					 <li><i class="fa-li fa fa-pause"></i> Pos. 1. a waiting period (e.g. let's say we know when exchange students will arrive in their host country, and do not ask questions before they've been there one week)</li>
					 <li><i class="fa-li fa fa-envelope"></i> Pos. 2. Now we have to send our exchange students an email to invite them to do the survey.</li>
					 <li><i class="fa-li fa fa-forward"></i> Pos. 3. a Skip Forward which checks <code>today() &gt; (exchange$arrival + weeks(2))</code>. The first dropdown is set to "if user reacts", the second to "automatically". It is set to jump to pos. 5.</li>
					 <li><i class="fa-li fa fa-envelope"></i> Pos. 4. This is our email reminder for the students who did not react after one week.</li>
					 <li><i class="fa-li fa fa-forward"></i> Pos. 5. a Skip Forward which checks <code>today() &lt; (exchange$arrival + weeks(10))</code>. The first dropdown is set to "automatically", the second to "if user reacts". It is set to jump to pos. 6.</li>
					 <li><i class="fa-li fa fa-pencil-square"></i> Pos. 5. the survey we want the exchange students to fill out</li>
					 <li><i class="fa-li fa fa-pause"></i> Pos. 6. Because this is a longitudinal study, we now wait for our exchange students to return home. The rest is left out.</li>
				 </ul>
				 <h5>What would happen?</h5>
				 <p>The pause would simply lead to all exchange students being invited once they've been in their host country for a week (we left out the part where we obtained the necessary information). After the invitation, however, we don't just give up, if they don't react. After another week has passed (two weeks in the host country), we remind them.<br>
			
				How is this done? It's just a little tricky:<br>
				The condition at pos. 3 says "if they have been in the host country less than two weeks". This is true directly after we sent the email (after all we invited them one week after their arrival and the run immediately goes on).<br>
				However, because this condition is time-dependent, it will change in a week and turn false.
				<br>Therefore we set the first dropdown to "if user reacts" (usually it's set to "automatically").<br>
				Now <a href="https://www.youtube.com/watch?v=rzgpu84nSoA#t=2m0s">if he doesn't answer</a>, the condition will become false and the run will automatically go on to the next position (4), which is our email reminder (tentatively titled "Oh lover boy..."). We hope for the user to click on the link in our invitation email before then.<br>
				If he does, he will jump to the survey.<br>
				<a href="https://www.youtube.com/watch?v=rzgpu84nSoA#t=2m3s">If he still doesn't answer</a>, we will patiently wait for another eight weeks. In this Skip Forward (5), all is reversed: We no longer check if they have been in the host country less than two weeks, we check whether they have been there longer than ten weeks, so at first this condition is false. We also switch the dropdowns: If the condition is false (ten weeks have not passed) and the user reacts, he goes on to the survey. If the condition turns true, we <em>automatically</em> jump to position 6, which stands for waiting for the second wave, so we gave up on getting a reaction in the first wave (but we still have "Baby, oh baby, My sweet baby, you're the one" up our sleeve).
			 </p>
	  </div>
	  </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#stop_point">
			<i class="fa-fw fa fa-stop"></i> Stop Point <br><small>you need at least one</small>
		</a>
	</div>
	<div id="stop_point" class="panel-collapse collapse stop_point">
				<div class="panel-body">
			  <p>
	 			 <i class="fa fa-stop fa-huge fa-fw pull-right"></i>
			  
				  You will always need at least one. These are stop points in your run, where you can give short or complex feedback, ranging from "You're not eligible to participate." to "This is the scatter plot of your mood and your alcohol consumption across the last two weeks".
			  </p> 
			  <p>
				  If you combine these end points with Skip Forward, you could have several in your run: You would use the Skip Forward to check whether users are eligible, and if so, skip over the stop point between the Skip Forward and the survey that they are eligible for. This way, ineligible users end up in a dead end before the survey. The run provides useful numbers on the left, so you can see how many people are ineligible by checking the count.<br>
				  See the <a href="#knitr" data-toggle="tab">Knitr &amp; Markdown</a> section to find out how to generate personalised feedback, including plots.
			</p>
			</div>
		</div>
	</div>
	
	
<div class="panel panel-default">
	<div class="panel-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#explanation_accordion" href="#shuffle">
			<i class="fa-fw fa fa-random"></i> Shuffle <br><small>randomise participants</small>
		</a>
	</div>
	<div id="shuffle" class="panel-collapse collapse shuffle">
				<div class="panel-body">
			  <p>
	 			 <i class="fa fa-random fa-huge fa-fw pull-right"></i>
				 This is a very simple component. You simply choose how many groups you want to randomly assign your participants to. We start counting at one (1), so if you have two groups you will check <code>shuffle$group == 1</code> and <code>shuffle$group == 2</code>. You can read a person's 
			group using <code>shuffle$group</code>. If you generate random groups at more than one
		point in a run, you might have to use the last one <code>tail(shuffle$group,1)</code> or check the unit id <code>shuffle$unit_id</code>, but
		usually you needn't do this.
			  </p> 
			  <p>
				  If you combine a Shuffle with Skip Forward, you could send one group to an entirely different arm/path of the study. But maybe you just want to randomly switch on a specific item in a survey - then you would use a "showif" in the survey item table containing e.g. <code>shuffle$group == 2</code>. The randomisation always has to occur before you try to use the number, but the user won't even notice it unless you tell him somehow (for example by switching on a note telling them which group they've been assigned to).
			</p>
			</div>
		</div>
	</div>

</div> <!-- closes panel group-->


