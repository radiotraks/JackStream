
<!DOCTYPE html> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Multi-page template</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head> 

	
<body> 

<!-- Start of first page: #one -->
<div data-role="page" id="one" >

	<div data-role="header">
		<h1>Multi-page</h1>
	</div><!-- /header -->

	<div data-role="content" >	
		<h2>Body swatch C</h2>
			<div class="ui-body ui-body-c">

				<div data-role="fieldcontain">
				    <fieldset data-role="controlgroup">
				    	<legend>Choose a pet:</legend>
				         	<input type="radio" name="radio-choice-1" id="radio-choice-1c" value="choice-1" />
				         	<label for="radio-choice-1c">Cat</label>

				         	<input type="radio" name="radio-choice-1" id="radio-choice-2c" value="choice-2"  />
				         	<label for="radio-choice-2c">Dog</label>

				         	<input type="radio" name="radio-choice-1" id="radio-choice-3c" value="choice-3"  />
				         	<label for="radio-choice-3c">Hamster</label>

				         	<input type="radio" name="radio-choice-1" id="radio-choice-4c" value="choice-4"  />
				         	<label for="radio-choice-4c">Lizard</label>
				    </fieldset>
				</div>

				<div data-role="fieldcontain">
		         <label for="name-c">Write In:</label>
		         <input type="text" name="name" id="name-c" placeholder="Write-In Vote"  />
				</div>

				<div class="ui-body ui-body-b">
		<fieldset class="ui-grid-a">
				<div class="ui-block-a"><button type="submit" data-theme="d">Cancel</button></div>
				<div class="ui-block-b"><button type="submit" data-theme="a">Submit</button></div>
	    </fieldset>
		</div>
				</div><!-- /body-c -->
</div>
		<h3>Show internal pages:</h3>
		<p><a href="#two" data-role="button" data-transition="slide">Show page "two"</a></p>	
		<p><a href="#popup"data-role="button" data-rel="dialog" data-transition="pop">Show page "popup" (as a dialog)</a></p>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="d">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page one -->


<!-- Start of second page: #two -->
<div data-role="page" id="two" data-theme="a">

	<div data-role="header">
		<h1>Two</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="a">	
		<h2>Two</h2>
		<p>I have an id of "two" on my page container. I'm the second page container in this multi-page template.</p>	
		<p>Notice that the theme is different for this page because we've added a few <code>data-theme</code> swatch assigments here to show off how flexible it is. You can add any content or widget to these pages, but we're keeping these simple.</p>	
		<p><a href="#one" data-direction="reverse" data-role="button" data-theme="b"  data-transition="slide">Back to page "one"</a></p>	
		
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page two -->


<!-- Start of third page: #popup -->
<div data-role="page" id="popup">

	<div data-role="header" data-theme="e">
		<h1>Dialog</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="d">	
		<h2>Popup</h2>
		<p>I have an id of "popup" on my page container and only look like a dialog because the link to me had a <code>data-rel="dialog"</code> attribute which gives me this inset look and a <code>data-transition="pop"</code> attribute to change the transition to pop. Without this, I'd be styled as a normal page.</p>		
		<p><a href="#one" data-rel="back" data-role="button" data-inline="true" data-icon="back">Back to page "one"</a></p>	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page popup -->

</body>
</html>