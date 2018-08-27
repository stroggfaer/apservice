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
		'icon-contacts': '&#xe900;',
		'icon-curer': '&#xe901;',
		'icon-ipad': '&#xe902;',
		'icon-iphone': '&#xe903;',
		'icon-mac': '&#xe904;',
		'icon-master': '&#xe905;',
		'icon-phone': '&#xe906;',
		'icon-start01': '&#xe907;',
		'icon-start02': '&#xe908;',
		'icon-start03': '&#xe909;',
		'icon-start04': '&#xe90a;',
		'icon-tv': '&#xe90b;',
		'icon-watch': '&#xe90c;',
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
