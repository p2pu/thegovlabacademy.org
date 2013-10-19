= THEME =

"Next Saturday"
Converted for WordPress.com from Tumblr, August 2011.

== FILES ==

- The /next-saturday directory has the updated files as launched on WordPress.com.

You can also access the theme files via Subversion:

- WordPress.org version: http://themes.svn.wordpress.org/next-saturday/1.0/  (after it has been approved for the directory)
- WordPress.com version: https://wpcom-themes.svn.automattic.com/next-saturday/

== CHANGELOG ==

- Converted the theme from Tumblr to WordPress
- HTML5 mark-up, with CSS3 effects
- Simplified some of the CSS 3D effects to avoid using extra presentation mark-up whereever possible:
   - Green 3D box: Used a single div with the box-shadow property. Older browsers get a box with a border.
   - Search field and search button: used box-shadows on the input box and search submit button elements
   - Red tagline bar: converted the shadow to a background image.
   - Primary and secondary columns: used box-shadow on these as well
   - Placed all post metadata in the same dark green box
   - All CSS class and ID names were converted to lowercase, with hyphens instead of underscores or camelcase (to comply with WordPress coding standards)
   - The "Next" and "Previous" arrows were converted to images.
- Added an RTL stylesheet
- Using the font "Verdana" to avoid potential licensing problems with the font used in the original version of the theme.
- Added support for comments
- Added a navigation menu with drop-down support
- Added support for Custom Background and Custom Header


== WORDPRESS.COM CHANGELOG ==

- Custom CSS to support WordPress.com widgets
- Header: default title element
- Footer: added WordPress.com link and link to original theme designer
- Added theme colors to functions.php