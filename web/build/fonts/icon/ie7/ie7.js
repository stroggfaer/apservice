/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-left-arrow': '&#xe915;',
		'icon-right-arrow': '&#xe916;',
		'icon-m': '&#xe914;',
		'icon-telegram': '&#xe900;',
		'icon-courier-image': '&#xe901;',
		'icon-email-image': '&#xe902;',
		'icon-map-image': '&#xe903;',
		'icon-menu_support': '&#xe904;',
		'icon-master-image': '&#xe905;',
		'icon-clock': '&#xe906;',
		'icon-wallet': '&#xe907;',
		'icon-car': '&#xe908;',
		'icon-icon-clock': '&#xe909;',
		'icon-icon-scope': '&#xe90a;',
		'icon-icon-security': '&#xe90b;',
		'icon-accessories': '&#xe90c;',
		'icon-tv': '&#xe90d;',
		'icon-ipad': '&#xe90e;',
		'icon-iphone': '&#xe90f;',
		'icon-ipod': '&#xe910;',
		'icon-monitor': '&#xe911;',
		'icon-mac': '&#xe912;',
		'icon-watch': '&#xe913;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
