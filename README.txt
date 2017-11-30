CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Installation
 * How to use


INTRODUCTION
------------

Current Maintainer: Katria Lesser, BYU Drupal Users Group

Views BYU Card module uses the styling of the
web componenet BYU-card to display nice cards in views.
You can see the byu-card project in github as well:
https://github.com/byuweb/byu-card


INSTALLATION
------------

1. Git clone or Download this module, placing views_card_d7 folder to sites/all/modules

2. Enable Views and Views BYU Card modules.

3. When editing the view you'd like to use byu card with,
Change the view display type (i.e. Unformatted List) to 'BYU Card' or 'BYU Feature Card'.

4. While still editing that view, under Fields settings,
uncheck 'Provide default field wrapper elements' checkbox.

5. Save the view.


HOW TO USE
------------

After enabling the module, create a new view with the BYU Card display
format.


Creating a color field:

1. From the admin menu, go to Structure -> Content Types -> [Content type of choice] -> Manage Fields

2. Add a new field called "Title Color" (machine name field_title_color) with a Field Type "List (text)"
   and the widget "Check boxes/radio buttons"

3. Save and, on the new screen, add the following to the Allowed values list:
navy-title|Navy
drupal-blue-title|Drupal Blue
royal-blue-title|Royal Blue
wordpress-gray-title|WordPress Gray
dark-gray-title|Dark Gray
gray-title|Gray

4. Save the field settings and, on the new screen, mark the field as required. You may set a default value if you wish.
   Allow only one in the Number of values and the values copied above should appear in the the Allowed values list.

5. Save the settings. Now your field is set up. You'll now need to go to the nodes of the content type it's applied to
   (you can apply it to other content types by typing "Title Color" into Add existing field) and choose a title color.


Setting up your BYU Feature Card view:

1. Follow the normal steps for a BYU Card, but note that there are additional setting options for the BYU Feature card. When you have selected your view to use the display type 'BYU Feature Card' the settings link will show a set of options.

2. Note that it contains settings for what content to place where in the Feature Card. These regions include "Title" (shown with a colored background on the top of the card), "Feature Top", "Feature Left", "Feature Right", and "Feature Center" (which shows below Feature Left & Feature Right).

These region settings can be empty (set to None) or you can specify your field(s) to go into them. Use ctrl or shift click to add multiple fields to a region. 

3. If you have to fields in a region like Feature Left, note that the order of those two fields is based on the order they are listed in the view. Modify the settings for your fields normally.

