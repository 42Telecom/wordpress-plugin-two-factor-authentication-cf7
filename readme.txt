=== Fortytwo - Two-Factor Authentication ===
Contributors: fortytwotele
Tags: 2fa, Two factor authentication, 2 factor authentication,  2 step authentication, 2-Factor, 2-step verification, login, register, contact form 7, cf7
Requires at least: 4.4
Tested up to: 5.6
Stable tag: 1.0.1
License: MIT
License URI: https://opensource.org/licenses/MIT

Fortytwo’s 2FA plugin for Contact Form 7 allow you to verify phone number on form submission.

== Description ==

= What is Two-factor Authentication? =

Authentication - the process of verifying your identity - boils down to one of three simple elements:

* Something the user knows (PIN, password)
* Something the user owns (mobile phone, device)
* Something the user is (biometric, retina, fingerprint)

[Two-factor Authentication](https://www.fortytwo.com/solutions/two-factor-authentication/) (2FA) is a combination of any two of these unique identifiers.

= How does our 2FA plugin work? =

With [Fortytwo](https://www.fortytwo.com)’s 2FA WordPress for Contact Form 7 plugin, you can create a form with a mobile phone field to receive the one-time validation code via SMS.

Our plugin is fully customisable and can be adapted to meet your specific needs, for example, you can assign 2FA to certain users depending on their specific administrative roles in Wordpress and disable 2FA for users when they are using a known or ‘trusted’ device for a specific period of time. Fortytwo’s Wordpress 2FA plugin offers the unique advantage of providing a highly customisable authentication process for users and provides an additional level of security when and as required.

= What features does it include? =

Fortytwo’s WordPress plugin comes with a myriad of features including the option to:
* New option to transform a telephone number as 2FA phone number in Contact Form  7
* Option to resend the SMS code if necessary
* **to customize the behavior of the 2FA as [documented on the API](https://www.fortytwo.com/apis/two-factor-authentication/)** including changes to the authentication code length and type (numeric, alpha or alphanumeric), case sensitive validation, options to log a response via a callback URL and customise sender ID ‘s visible to the users

Fortytwo’s 2FA Wordpress for Contact Form 7 plugin supports 2FA for all Smart phones (iPhone, Android, BlackBerry), as well as basic phones.

= Why use Fortytwo’s WordPress plugin? =

* **Security** Incorporating 2FA, creates a level of protection and security for your WordPress site that complex passwords can no longer guarantee
* **Customised functionality** This is our first version of the plugin and we’re keenly interested in your feedback.

If there is additional functionality that you would you like to see, please let us know - we are happy to work on developing features to meet your specific requirements and endeavor to implement this in as short a time-frame as possible.

== Installation ==

Installing "Fortytwo Two Factor Authentication plugin" can be done either by searching for "Fortytwo Two Factor Authentication" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
1. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
1. Activate the plugin through the 'Plugins' menu in WordPress

== Configuration ==

Once the plugin is activated you have to configure the plugin before use:

1. In the admin panel go to **Contact Form > Two Factor Authentication**
1. Enter the token you have from the [fortytwo control panel](https://controlpanel.fortytwo.com/)
1. Configure the other options accordingly to your needs
1. push the save button

== How to use it ==

1. Create a form with Contact Form 7 plugin.
1. You need to include a phone field (tel or tel*).
1. In the phone field tag you have to add a class 2fa-phone (class:2fa-phone).

**Note:** The Two factor authentication works only for the users who have the 2FA phone number on their profile.

== Frequently Asked Questions ==

= Where can I report a bug? =

The project is managed with Github. So you can report an issues on our [Repository](https://github.com/42Telecom/wordpress-plugin-two-factor-authentication "Fortytwo Two Factor Authentication").

== Changelog ==

== Version 1.0.0 ==
_2016-10-24_
* First stable version
