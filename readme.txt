=== Unwrap Shortlinks ===

Stable tag: 0.2.3  
Tags: urls, links, classicpress  
Requires at least: 3.0  
Tested up to: 6.0  
Requires PHP: 7.0  
Contributors: Kelson  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html
For ClassicPress  
Requires: 1.0  
Tested: 1.4.1

Follow shortened links (t.co, bit.ly, etc) and expand them so that your blog post will point directly to the destination.

== Description ==

Automatically expands URLs at the following known link shorteners when you save a post:
* t.co
* bit.ly
* ow.ly
* j.mp
* is.gd
* trib.al
* buff.ly
* wp.me
* tmblr.co
* tinyurl.com
* goo.gl
* dlvr.it
* fb.me
* qr.ae

== Installation ==

Install the plugin and activate it. The next time you paste a supported short URL into a post, it will be updated when the post is saved.

== Frequently Asked Questions ==

= What if the destination redirects to another link? =

At the moment it'll stop at the first one to avoid infinite redirect loops. But if the destination is another known shortener (say you had a t.co link that redirected to a bit.ly link), the next time you save the post, it will follow that one to its destination. TODO: I plan to make it follow a limited chain of known shorteners.

= How do I add a shortener to the list? =

It's not supported yet, but I plan on adding an options page for it.

= I'm running on a local server and this doesn't do anything! =

Most likely your system is configured to block your local webserver
from making outgoing connections. This is a sensible default for security!
Depending on your system, it may be blocked by a local or network firewall.
If you're running Fedora Workstation with SELinux (like I am), this will enable it:
```
sudo setsebool -P httpd_can_network_connect true
```

Thanks to [igienger's post](https://wordpress.org/support/topic/error-curl-error-7-3/#post-12637512) on the WordPress support forums!

= What about compatibility? =

It should work going back to the classic editor and forward to the block editor. It even works on [ClassicPress](https://www.classicpress.net/).

== Changelog ==

= [0.2.3] - 2022-06-10 =
* Fix bugs with tinyurl.com and URLs inside HTML links. (Plaintext URLs were working fine.)

= [0.2.2] - 2022-01-29 =

* Initial release based on the code I've been running locally for years, plus changes requested by the WordPress plugin review team.

[Source on Codeberg](https://codeberg.org/kvibber/unwrap-shortlinks).  
[Plugin page at WordPress](https://wordpress.org/plugins/unwrap-shortlinks/).

(c) 2016-2022 [Kelson Vibber](https://kvibber.com/)
