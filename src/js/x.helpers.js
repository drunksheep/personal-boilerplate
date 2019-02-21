window.helpers = {
    lockBody: function () {
        document.querySelector('html').classList.add('no-scroll');
    },
    unlockBody: function () {
        document.querySelector('html').classList.remove('no-scroll');
    },

    isMobile: window.innerWidth < 1023 ? true : false,

    iOS: !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform),

    IE: function () {

        var sAgent = window.navigator.userAgent;
        var Idx = sAgent.indexOf("MSIE");

        if (Idx > 0 || !!navigator.userAgent.match(/Trident\/7\./) || document.documentMode || /Edge/.test(navigator.userAgent)) {
            return true;
        } else {
            return false;
        }

    },

    hoisted: JSON.parse(window.Hoist),

    photoshopLetterSpacingToPx: function (val, size) {
        var res = val * size / 1000;
        return res;
    },
}