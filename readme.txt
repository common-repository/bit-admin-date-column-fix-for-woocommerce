
=== BlackIce Admin Date Column fix for WooCommerce===
Contributors: blackicelmtd
Donate link: http://www.blackicetrading.com
Tags: woocommerce, orders, admin, date, column
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tested up to: 6.2
WC requires at least: 6.0.0
WC tested up to: 7.5.1

Adds the full time and date to the date column for those that find the '1 hour ago' stupid.

== Description ==

Adds the full time and date to the date column for those that find the '1 hour ago' stupid.
This isn't the best fix going, since the core function render_order_date_column in https://github.com/woocommerce/woocommerce/blob/a7d57a248ed03dac7bad119e71f83dd961f43cb3/includes/admin/list-tables/class-wc-admin-list-table-orders.php 
does not (imo) implent a filter correctly. You can add a filter for the date column, BUT it's only effective on the field for orders greater than 1 day.

This is a quick fix to add a full time and date alongside the '1 hour' output without affecting it or duplicating the output on orders greater than 1 day.

== Installation ==

1. Upload `blackice-woocommerce-admin-date-column` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
= Can I change the format? =
At present no, it's hard coded.

= Why can't I just apply a filter? =
Because apply_filters( 'woocommerce_admin_order_date_format is badly implemented in core.

= Why is this needed? =
Because seeing 1/5/18 hours ago is relative to when the page was last refreshed. Users have no idea on glacing whether the page has been refreshed and you looking at the most recent orders. It's an issue I raised during the release of this change and was told 'just use a filter if you want it back' BUT that doesn't work.

== Screenshots ==

== Changelog ==

= 1.2.0 =
* Renamed files to match SVN submission.
* Update version info.

= 1.1.0 =
* Update: Rename plugin from bit to blackice
* Update: Tested upto version info.

= 1.0.1 =
* Update version info.

= 1.0 =
* Creation of the plugin
