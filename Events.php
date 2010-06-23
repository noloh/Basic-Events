<?php

/* Events
An example demonstrating the basics of handling Events.
Difficulty level: Beginner */

//Includes NOLOH for your project.
require_once('/PATH/TO/NOLOH');

/* Your application must have one class that extends WebPage,
   this will be used as the starting point for your application. */
class Events extends WebPage
{
	/* A class variable used to keep track of the Left coordinate used for new 
	   Buttons. The initial value will be 50 pixels. */
	private $CurrentLeft = 50;
	/* A class variable used to keep track of the Top coordinate used for new
	   Buttons. The initial value will be 30 pixels. */
	private $CurrentTop = 30;
    /* Constructor to your class. This automatically gets called
	   when a new instance of HelloWorld is created. NOLOH will create
	   this initial instance for you. */
	   
	function Events()
	{
		/* Calls the WebPage's constructor. This must be done to
		   ensure that WebPage is properly instantiated. The 
		   parameter specifies a string to be displayed in the
		   browser's title bar. */
		parent::WebPage('Demonstrating basic Events');
		// Calls the CreateButton function, which is defined below
		$this->CreateButton();
	}
	function CreateButton()
	{
		/* Creates an instance of a NOLOH Button object, giving it
		   the label 'Click Me!', a Left and Top coordinates equal
		   to the class variables, and a Width of 150 pixels. The 
		   Button object is then stored in a local variable named 
		   $button. 
		   
		   NOLOH object size and position are provided in Left, Top,
		   Width, Height order. All are optional but if any is specified,
		   all those to its left in the argument list must also be specified. */
		$button = new Button('Click Me!', $this->CurrentLeft, $this->CurrentTop, 150);
		/* Adds the Button object to the WebPage's ArrayList called Controls.
		   Without this line, a Button is merely created, but will
		   not be displayed. */
		$this->Controls->Add($button);
		/* Increases the class variable for Left by 50 pixels so that subsequent
		   Buttons will appear to the right. */
		$this->CurrentLeft += 50;
		/* Increases the class variable for Top by 30 pixels so that subsequent
		   Buttons will appear below. */
		$this->CurrentTop += 30;
		/* Sets the Click Event for this Button to call the
		   CreateButton function of this object. Thus, every
		   Button will be able to create other Buttons. 
		   
		   The first parameter tells NOLOH in which class definition the event
		   is defined. The second parameter is the name of the event to be
		   called. */
		$button->Click = new ServerEvent($this, 'CreateButton');
		/* The following line demonstrates two more aspects
		   of Events. First of all, we can use the Click[] = 
		   notation to append another ServerEvent to the Click. 
		   Thus, Events can be treated like arrays in NOLOH. Now
		   the Click will perform two separate tasks in the defined order.
		   Secondly, a ServerEvent does not have to call a
		   function of the $this object, but it can be any
		   object whatsoever. We will call a function of the
		   Button itself, namely, SetText, to set the Text
		   to something else. Parameters to functions are given
		   by any additional parameters to ServerEvent, so
		   the button's text will be set to 'Thanks! Click Again!'
		   In short, clicking on the button will perform the
		   statement: $button->SetText('Thanks! Click Again!'); */
		$button->Click[] = new ServerEvent($button, 'SetText', 'Thanks! Click Again!');
		/* In summary, clicking on any Button will make another
		   Button below and to the right of the clicked button, as well
		   as change the clicked button's Text (or label). */
	}
}
?>