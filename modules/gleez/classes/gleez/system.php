<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Gleez Core Utils class
 *
 * @package    Gleez
 * @category   Core/Utils
 * @author     Sergey Yakovlev - Gleez
 * @author     Sandeep Sangamreddi - Gleez
 * @copyright  (c) 2011-2013 Gleez Technologies
 * @license    http://gleezcms.org/license Gleez CMS License Agreement
 */
class Gleez_System {
	
	/**
	 * Get the server load averages (if possible)
	 *
	 * @return  string
	 * @link    http://php.net/manual/en/function.sys-getloadavg.php sys-getloadavg()
	 */
	public static function get_avg()
	{
		// Default return
		$not_available = __('Not available');
		
		if (function_exists('sys_getloadavg') && is_array(sys_getloadavg()))
		{
			$load_averages = sys_getloadavg();
			array_walk($load_averages, create_function('&$v', '$v = round($v, 3);'));
			$server_load = $load_averages[0] . ' ' . $load_averages[1] . ' ' . $load_averages[2];
		}
		elseif (@is_readable('/proc/loadavg'))
		{
			// We use @ just in case
			$fh            = @fopen('/proc/loadavg', 'r');
			$load_averages = @fread($fh, 64);
			@fclose($fh);
			
			$load_averages = empty($load_averages) ? array() : explode(' ', $load_averages);
			
			$server_load = isset($load_averages[2]) ? $load_averages[0] . ' ' . $load_averages[1] . ' ' . $load_averages[2] : $not_available;
		}
		elseif (!in_array(PHP_OS, array(
			'WINNT',
			'WIN32'
		)) && preg_match('/averages?: ([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/i', @exec('uptime'), $load_averages))
		{
			$server_load = $load_averages[1] . ' ' . $load_averages[2] . ' ' . $load_averages[3];
		}
		else
			$server_load = $not_available;
		
		return $server_load;
	}
	
	/**
	 * Attempts to create the directory specified by `$path`
	 *
	 * To create the nested structure, the `$recursive` parameter
	 * to mkdir() must be specified.
	 *
	 * @param   string  $path       The directory path
	 * @param   integer $mode       Set permission mode (as in chmod) [Optional]
	 * @param   boolean $recursive  Create directories recursively if necessary [Optional]
	 * @return  boolean             Returns TRUE on success or FALSE on failure
	 *
	 * @link    http://php.net/manual/en/function.mkdir.php mkdir()
	 */
	public static function mkdir($path, $mode = 0777, $recursive = TRUE)
	{
		$oldumask = umask(0);
		if (!is_dir($path))
		{
			return @mkdir($path, $mode, $recursive);
		}
		umask($oldumask);
	}
	
	public static function icons()
	{
		$icons = array(
			"icon-cloud-download" => ' cloud-download',
			"icon-cloud-upload" => 'cloud-upload',
			"icon-lightbulb" => 'lightbulb',
			"icon-exchange" => 'exchange',
			"icon-bell-alt" => 'bell-alt',
			"icon-file-alt" => 'file-alt',
			"icon-beer" => 'beer',
			"icon-coffee" => 'coffee',
			"icon-food" => 'food',
			"icon-fighter-jet" => 'fighter-jet',
			
			"icon-user-md" => 'user-md',
			"icon-stethoscope" => 'stethoscope',
			"icon-suitcase" => 'suitcase',
			"icon-building" => 'building',
			"icon-hospital" => 'hospital',
			"icon-ambulance" => 'ambulance',
			"icon-medkit" => 'medkit',
			"icon-h-sign" => 'h-sign',
			"icon-plus-sign-alt" => 'plus-sign-alt',
			"icon-spinner" => 'spinner',
			
			"icon-angle-left" => 'angle-left',
			"icon-angle-right" => 'angle-right',
			"icon-angle-up" => 'angle-up',
			"icon-angle-down" => 'angle-down',
			"icon-double-angle-left" => 'double-angle-left',
			"icon-double-angle-right" => 'double-angle-right',
			"icon-double-angle-up" => 'double-angle-up',
			"icon-double-angle-down" => 'double-angle-down',
			"icon-circle-blank" => 'circle-blank',
			"icon-circle" => 'circle',
			
			"icon-desktop" => 'desktop',
			"icon-laptop" => 'laptop',
			"icon-tablet" => 'tablet',
			"icon-mobile-phone" => 'mobile-phone',
			"icon-quote-left" => 'quote-left',
			"icon-quote-right" => 'quote-right',
			"icon-reply" => 'reply',
			"icon-github-alt" => 'github-alt',
			"icon-folder-close-alt" => 'folder-close-alt',
			"icon-folder-open-alt" => 'folder-open-alt',
			
			"icon-adjust" => 'adjust',
			"icon-asterisk" => 'asterisk',
			"icon-ban-circle" => 'ban-circle',
			"icon-bar-chart" => 'bar-chart',
			"icon-barcode" => 'barcode',
			"icon-beaker" => 'beaker',
			"icon-beer" => 'beer',
			"icon-bell" => 'bell',
			"icon-bell-alt" => 'bell-alt',
			"icon-bolt" => 'bolt',
			"icon-book" => 'book',
			"icon-bookmark" => 'bookmark',
			"icon-bookmark-empty" => 'bookmark-empty',
			"icon-briefcase" => 'briefcase',
			"icon-bullhorn" => 'bullhorn',
			"icon-calendar" => 'calendar',
			"icon-camera" => 'camera',
			"icon-camera-retro" => 'camera-retro',
			"icon-certificate" => 'certificate',
			"icon-check" => 'check',
			"icon-check-empty" => 'check-empty',
			"icon-circle" => 'circle',
			"icon-circle-blank" => 'circle-blank',
			"icon-cloud" => 'cloud',
			"icon-cloud-download" => 'cloud-download',
			"icon-cloud-upload" => 'cloud-upload',
			"icon-coffee" => 'coffee',
			"icon-cog" => 'cog',
			"icon-cogs" => 'cogs',
			"icon-comment" => 'comment',
			"icon-comment-alt" => 'comment-alt',
			"icon-comments" => 'comments',
			"icon-comments-alt" => 'comments-alt',
			"icon-credit-card" => 'credit-card',
			"icon-dashboard" => 'dashboard',
			"icon-desktop" => 'desktop',
			"icon-download" => 'download',
			"icon-download-alt" => 'download-alt',
			
			"icon-edit" => 'edit',
			"icon-envelope" => 'envelope',
			"icon-envelope-alt" => 'envelope-alt',
			"icon-exchange" => 'exchange',
			"icon-exclamation-sign" => 'exclamation-sign',
			"icon-external-link" => 'external-link',
			"icon-eye-close" => 'eye-close',
			"icon-eye-open" => 'eye-open',
			"icon-facetime-video" => 'facetime-video',
			"icon-fighter-jet" => 'fighter-jet',
			"icon-film" => 'film',
			"icon-filter" => 'filter',
			"icon-fire" => 'fire',
			"icon-flag" => 'flag',
			"icon-folder-close" => 'folder-close',
			"icon-folder-open" => 'folder-open',
			"icon-folder-close-alt" => 'folder-close-alt',
			"icon-folder-open-alt" => 'folder-open-alt',
			"icon-food" => 'food',
			"icon-gift" => 'gift',
			"icon-glass" => 'glass',
			"icon-globe" => 'globe',
			"icon-group" => 'group',
			"icon-hdd" => 'hdd',
			"icon-headphones" => 'headphones',
			"icon-heart" => 'heart',
			"icon-heart-empty" => 'heart-empty',
			"icon-home" => 'home',
			"icon-inbox" => 'inbox',
			"icon-info-sign" => 'info-sign',
			"icon-key" => 'key',
			"icon-leaf" => 'leaf',
			"icon-laptop" => 'laptop',
			"icon-legal" => 'legal',
			"icon-lemon" => 'lemon',
			"icon-lightbulb" => 'lightbulb',
			"icon-lock" => 'lock',
			"icon-unlock" => 'unlock',
			
			"icon-magic" => 'magic',
			"icon-magnet" => 'magnet',
			"icon-map-marker" => 'map-marker',
			"icon-minus" => 'minus',
			"icon-minus-sign" => 'minus-sign',
			"icon-mobile-phone" => 'mobile-phone',
			"icon-money" => 'money',
			"icon-move" => 'move',
			"icon-music" => 'music',
			"icon-off" => 'off',
			"icon-ok" => 'ok',
			"icon-ok-circle" => 'ok-circle',
			"icon-ok-sign" => 'ok-sign',
			"icon-pencil" => 'pencil',
			"icon-picture" => 'picture',
			"icon-plane" => 'plane',
			"icon-plus" => 'plus',
			"icon-plus-sign" => 'plus-sign',
			"icon-print" => 'print',
			"icon-pushpin" => 'pushpin',
			"icon-qrcode" => 'qrcode',
			"icon-question-sign" => 'question-sign',
			"icon-quote-left" => 'quote-left',
			"icon-quote-right" => 'quote-right',
			"icon-random" => 'random',
			"icon-refresh" => 'refresh',
			"icon-remove" => 'remove',
			"icon-remove-circle" => 'remove-circle',
			"icon-remove-sign" => 'remove-sign',
			"icon-reorder" => 'reorder',
			"icon-reply" => 'reply',
			"icon-resize-horizontal" => 'resize-horizontal',
			"icon-resize-vertical" => 'resize-vertical',
			"icon-retweet" => 'retweet',
			"icon-road" => 'road',
			"icon-rss" => 'rss',
			"icon-screenshot" => 'screenshot',
			"icon-search" => 'search',
			
			"icon-share" => 'share',
			"icon-share-alt" => 'share-alt',
			"icon-shopping-cart" => 'shopping-cart',
			"icon-signal" => 'signal',
			"icon-signin" => 'signin',
			"icon-signout" => 'signout',
			"icon-sitemap" => 'sitemap',
			"icon-sort" => 'sort',
			"icon-sort-down" => 'sort-down',
			"icon-sort-up" => 'sort-up',
			"icon-spinner" => 'spinner',
			"icon-star" => 'star',
			"icon-star-empty" => 'star-empty',
			"icon-star-half" => 'star-half',
			"icon-tablet" => 'tablet',
			"icon-tag" => 'tag',
			"icon-tags" => 'tags',
			"icon-tasks" => 'tasks',
			"icon-thumbs-down" => 'thumbs-down',
			"icon-thumbs-up" => 'thumbs-up',
			"icon-time" => 'time',
			"icon-tint" => 'tint',
			"icon-trash" => 'trash',
			"icon-trophy" => 'trophy',
			"icon-truck" => 'truck',
			"icon-umbrella" => 'umbrella',
			"icon-upload" => 'upload',
			"icon-upload-alt" => 'upload-alt',
			"icon-user" => 'user',
			"icon-user-md" => 'user-md',
			"icon-volume-off" => 'volume-off',
			"icon-volume-down" => 'volume-down',
			"icon-volume-up" => 'volume-up',
			"icon-warning-sign" => 'warning-sign',
			"icon-wrench" => 'wrench',
			"icon-zoom-in" => 'zoom-in',
			"icon-zoom-out" => 'zoom-out',
			
			"icon-file" => 'file',
			"icon-file-alt" => 'file-alt',
			"icon-cut" => 'cut',
			"icon-copy" => 'copy',
			"icon-paste" => 'paste',
			"icon-save" => 'save',
			"icon-undo" => 'undo',
			"icon-repeat" => 'repeat',
			
			"icon-text-height" => 'text-height',
			"icon-text-width" => 'text-width',
			"icon-align-left" => 'align-left',
			"icon-align-center" => 'align-center',
			"icon-align-right" => 'align-right',
			"icon-align-justify" => 'align-justify',
			"icon-indent-left" => 'indent-left',
			"icon-indent-right" => 'indent-right',
			
			"icon-font" => 'font',
			"icon-bold" => 'bold',
			"icon-italic" => 'italic',
			"icon-strikethrough" => 'strikethrough',
			"icon-underline" => 'underline',
			"icon-link" => 'link',
			"icon-paper-clip" => 'paper-clip',
			"icon-columns" => 'columns',
			
			"icon-table" => 'table',
			"icon-th-large" => 'th-large',
			"icon-th" => 'th',
			"icon-th-list" => 'th-list',
			"icon-list" => 'list',
			"icon-list-ol" => 'list-ol',
			"icon-list-ul" => 'list-ul',
			"icon-list-alt" => 'list-alt',
			
			"icon-angle-left" => 'angle-left',
			"icon-angle-right" => 'angle-right',
			"icon-angle-up" => 'angle-up',
			"icon-angle-down" => 'angle-down',
			"icon-arrow-down" => 'arrow-down',
			"icon-arrow-left" => 'arrow-left',
			"icon-arrow-right" => 'arrow-right',
			"icon-arrow-up" => 'arrow-up',
			
			"icon-caret-down" => 'caret-down',
			"icon-caret-left" => 'caret-left',
			"icon-caret-right" => 'caret-right',
			"icon-caret-up" => 'caret-up',
			"icon-chevron-down" => 'chevron-down',
			"icon-chevron-left" => 'chevron-left',
			"icon-chevron-right" => 'chevron-right',
			"icon-chevron-up" => 'chevron-up',
			
			"icon-circle-arrow-down" => 'circle-arrow-down',
			"icon-circle-arrow-left" => 'circle-arrow-left',
			"icon-circle-arrow-right" => 'circle-arrow-right',
			"icon-circle-arrow-up" => 'circle-arrow-up',
			"icon-double-angle-left" => 'double-angle-left',
			"icon-double-angle-right" => 'double-angle-right',
			"icon-double-angle-up" => 'double-angle-up',
			"icon-double-angle-down" => 'double-angle-down',
			
			"icon-hand-down" => 'hand-down',
			"icon-hand-left" => 'hand-left',
			"icon-hand-right" => 'hand-right',
			"icon-hand-up" => 'hand-up',
			"icon-circle" => 'circle',
			"icon-circle-blank" => 'circle-blank',
			
			"icon-play-circle" => 'play-circle',
			"icon-play" => 'play',
			"icon-pause" => 'pause',
			"icon-stop" => 'stop',
			
			"icon-step-backward" => 'step-backward',
			"icon-fast-backward" => 'fast-backward',
			"icon-backward" => 'backward',
			"icon-forward" => 'forward',
			
			"icon-fast-forward" => 'fast-forward',
			"icon-step-forward" => 'step-forward',
			"icon-eject" => 'eject',
			
			"icon-fullscreen" => 'fullscreen',
			"icon-resize-full" => 'resize-full',
			"icon-resize-small" => 'resize-small',
			
			"icon-phone" => 'phone',
			"icon-phone-sign" => 'phone-sign',
			"icon-facebook" => 'facebook',
			"icon-facebook-sign" => 'facebook-sign',
			
			"icon-twitter" => 'twitter',
			"icon-twitter-sign" => 'twitter-sign',
			"icon-github" => 'github',
			"icon-github-alt" => 'github-alt',
			
			"icon-github-sign" => 'github-sign',
			"icon-linkedin" => 'linkedin',
			"icon-linkedin-sign" => 'linkedin-sign',
			"icon-pinterest" => 'pinterest',
			
			"icon-pinterest-sign" => 'pinterest-sign',
			"icon-google-plus" => 'google-plus',
			"icon-google-plus-sign" => 'google-plus-sign',
			"icon-sign-blank" => 'sign-blank',
			
			"icon-ambulance" => 'ambulance',
			"icon-beaker" => 'beaker',
			
			"icon-h-sign" => 'h-sign',
			"icon-hospital" => 'hospital',
			
			"icon-medkit" => 'medkit',
			"icon-plus-sign-alt" => 'plus-sign-alt',
			
			"icon-stethoscope" => 'stethoscope',
			"icon-user-md" => 'user-md'
		);
		
		//sort icons by natural order
		natsort($icons);
		
		$icons = array("icon-none" => __('none')) + $icons;

		return $icons;
	}
}