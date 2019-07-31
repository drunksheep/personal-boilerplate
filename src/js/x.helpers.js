const helpers = {
	lockBody: () => {
		document.querySelector('html').classList.add('no-scroll');
		document.querySelector('body').classList.add('no-scroll');
	},

	unlockBody: () => {
		document.querySelector('html').classList.remove('no-scroll');
		document.querySelector('body').classList.remove('no-scroll');
	},

	isMobile : window.innerWidth < 1023 ? true : false,

	iOS : !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform),

	IE: () =>  {

		var sAgent = window.navigator.userAgent;
		var Idx = sAgent.indexOf("MSIE");

		if (Idx > 0 || !!navigator.userAgent.match(/Trident\/7\./) || document.documentMode || /Edge/.test(navigator.userAgent)) {
			return true;
		} else {
			return false;
		}

	},

	photoshopLetterSpacingToPx: (val, size) => {
		var res = val * size / 1000;
		return res;
	},
}

