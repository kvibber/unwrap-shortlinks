# Unwrap Shortlinks

Stable tag: 0.3.4  
Tags: urls, links, classicpress  
Tested up to: 6.6  
Contributors: Kelson  
License: GPLv2 or later

Follows shortened links (t.co, bit.ly, etc) and WordPress' ?p=123-style links, and expands them so that your blog post will point directly to the destination.

## Description

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
* goo.gl
* dlvr.it
* fb.me
* qr.ae
* aka.ms
* tinyurl.com

## Installation

Install the plugin and activate it. The next time you paste a supported short URL into a post, it will be updated when the post is saved.

## Frequently Asked Questions

### What if the destination redirects to another link?

If the destination is another known URL shortener (ex. t.co pointing to bit.ly pointing to wp.me pointing to a blog post), it'll keep going up to 8 levels (to avoid infinite loops!) or until it gets a URL that isn't on the list. 

### How do I add a shortener to the list?

It's not supported yet, but I plan on adding an options page for it.

### I'm running on a local server and this doesn't do anything!

Most likely your system is configured to block your local webserver
from making outgoing connections. This is a sensible default for security!
Depending on your system, it may be blocked by a local or network firewall.
If you're running Fedora Workstation with SELinux (like I am), this will enable it:
```
sudo setsebool -P httpd_can_network_connect true
```

Thanks to [igienger's post](https://wordpress.org/support/topic/error-curl-error-7-3/#post-12637512) on the WordPress support forums!

### What about compatibility?

It should work going back to the classic editor and forward to the block editor. It even works on [ClassicPress](https://www.classicpress.net/).

## Changelog

### [0.3.4] - 2024-07-07
* Also follow WordPress' ?p=123 links if they redirect to a permalink.
* tinyurl.com is accepting curl requests again, so I've added it back to the list.

### [0.3.3] - 2023-07-22
* tinyurl.com is screening requests using Cloudflare, and a simple curl request is no longer allowed through. Removing it from the list.

### [0.3.2] - 2022-10-29
* Tested up through 6.1, clean up headers, no functional changes.

### [0.3.1] - 2022-09-01
* Update headers for new ClassicPress plugin directory. No changes affecting WordPress

### [0.3.0] - 2022-06-23
* Follow link trails, add aka.ms.

### [0.2.4] - 2022-06-13
* Fix bugs with plaintext URLs at the end of a block.

### [0.2.3] - 2022-06-10
* Fix bugs with tinyurl.com and URLs inside HTML links. (Plaintext URLs were working fine.)

### [0.2.2] - 2022-01-29

* Initial release based on the code I've been running locally for years, plus changes requested by the WordPress plugin review team.

[Source on Codeberg](https://codeberg.org/kvibber/unwrap-shortlinks).  
[Mirror on GitHub](https://github.com/kvibber/unwrap-shortlinks).  
[Plugin page at WordPress](https://wordpress.org/plugins/unwrap-shortlinks/).  
[Plugin page at ClassicPress](https://directory.classicpress.net/plugins/unwrap-shortlinks).

(c) 2016-2024 [Kelson Vibber](https://kvibber.com/)
