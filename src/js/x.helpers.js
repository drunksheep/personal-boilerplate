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

    wpVars : window.wpVars !== undefined ? JSON.parse(window.wpVars) : false,

	photoshopLetterSpacingToPx: (val, size) => {
		var res = val * size / 1000;
		return res;
	},
}

/**
 * @param {DOMTokenNode} el Element to apply
 * @param {Function} cb Callback Function
 * @see https://gist.github.com/alirezas/c4f9f43e9fe1abba9a4824dd6fc60a55
 * FadeOut polyfill for vanilla JS
*/

const fadeOut = (el, cb) => {
    el.style.opacity = 1;

    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();

    if (typeof cb === 'function') {
        cb();
    }
}

/**
 * @param {DOMTokenNode} el Element to apply
 * @param {String} display What display property should be applied to the element after fading in. Defaults to Block
 * @param {Function} cb Callback Function
 * @see https://gist.github.com/alirezas/c4f9f43e9fe1abba9a4824dd6fc60a55
 * FadeIn polyfill for vanilla JS
*/

const fadeIn = (el, display, cb) => {
    el.style.opacity = 0;
    el.style.display = display || 'block';

    (function fade() {
        var val = parseFloat(el.style.opacity);
        if (!((val += .075) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();

    if ( typeof cb === 'function' ) {
        cb();
    }
}

/**
 * @method deferIframeLoading | Loads iframes after initial page load for better performance
 * @param {String} selector | iframes to apply deferred loading
 * @param {Int} delay | Delay time before loading
 *
 */

const deferIframeLoading = (selector, delay) => {
    const iframes = document.querySelectorAll(selector);
    setTimeout(() => {
        iframes.forEach(iframe => {
            iframe.dataset.source !== '' ?
            iframe.src = iframe.dataset.source :
            console.error(`Missing data-source attribute on iframe: ${iframe}`);
        });
    }, delay);
}

/**
 * @method fetchResults
 * @param {String} url | URL to fetch
 * @param {String} actionName | WP action name
 * @param {Object} body | POST body if exists
 * @description Fetch helper for wordpress
*/

const fetchResults = (url, actionName, body) => {
    const config = {
        method: typeof body === undefined || null ? 'GET' : 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Cache-Control': 'no-cache',
        },
        credentials: 'same-origin'
    }

    if ( body ) {
        config.body = JSON.stringify(body)
    }

    let request = fetch(`${url}?action=${actionName}`, config)
    .then(response => response.json())

    return request;
}