CONTENTS OF THIS FILE
---------------------
 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Troubleshooting
 * FAQ
 * Maintainers


INTRODUCTION
------------

The E-mail Formatter module is a field formatter for the Email field (in Drupal
8 core) to allow email field addresses to be:

 * rendered with mailto: links
 * truncated to a specified number of characters for rendering, and if
   truncated then ended with an ellipsis (…)
 * preceded by
   * custom text
   * custom HTML
   * an appropriate Font Awesome icon, which can also be rendered as a mailto:
     link to the address

 * For more information, visit the project page:
  https://drupal.org/project/email_formatter

 * To submit bug reports and feature suggestions, or to track changes:
  https://drupal.org/project/issues/email_formatter


REQUIREMENTS
------------

None, but if the icons option is used, then the Font Awesome icons module that
adds the FA project to Drupal, allowing the icons to be displayed:

 * Font Awesome (https://drupal.org/project/fontawesome) (at least version
   8.x-2.x)

If you're using it, don't forget to add/upgrade to the latest version of Font
Awesome via your /admin/config/content/fontawesome settings.


INSTALLATION
------------
Install as you would normally install a contributed drupal module. See:
https://www.drupal.org/docs/8/extending-drupal-8/installing-drupal-8-modules
for further information.


CONFIGURATION
-------------
 * Just head to a content type display management tab
   (ex. http://yoursite.com/admin/structure/types/manage/yourtype/display) where
   you have an email field/fields. In the format column for the email field that
   you want to use this formatter, select the 'E-mail formatter (with options)'
   format, and save the form to put it into use.
 * Click the settings cog/gear button to view and edit the (hopefully)
   self-explanatory options for how the links should be displayed.
 * To customise the output further, just theme your pages as usual.


TROUBLESHOOTING
---------------
 * Try clearing all your caches using the performance configuration page should
   you encounter any issues.
 * Edit the settings for the problematic field, using the cog/gear button, to
   flush out any invalid settings from previous versions of this module.
 * Don't forget to add/upgrade to the latest version of Font Awesome via your
   /admin/config/content/fontawesome settings.


FUTURE PLANS
------------
* Support Twig templating of the output.


FAQ
---
None, yet.


MAINTAINERS
-----------
 * Dave Nattriss (natts) - https://drupal.org/u/natts


THANKS
------

The icons are from the Font Awesome project, by Greg Loucas and Dave Gandy:
 * https://fontawesome.com
 * https://twitter.com/gregoryLpaul
 * https://twitter.com/fontawesome

The font has been made available to Drupal in the fontawesome module by Rob
Loach (RobLoach) and Inder Singh (inders)
