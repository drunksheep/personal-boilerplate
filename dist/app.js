function init(){}function DOMLoaded(){helpers.iOS?document.querySelector("html").classList.add("ios"):helpers.IE()&&document.querySelector("html").classList.add("ie")}window.helpers={lockBody:function(){document.querySelector("html").classList.add("no-scroll"),document.querySelector("body").classList.add("no-scroll")},unlockBody:function(){document.querySelector("html").classList.remove("no-scroll"),document.querySelector("body").classList.remove("no-scroll")},isMobile:window.innerWidth<1023,iOS:!!navigator.platform&&/iPad|iPhone|iPod/.test(navigator.platform),IE:function(){return!!(0<window.navigator.userAgent.indexOf("MSIE")||navigator.userAgent.match(/Trident\/7\./)||document.documentMode||/Edge/.test(navigator.userAgent))},hoisted:JSON.parse(window.Hoist),photoshopLetterSpacingToPx:function(e,o){return e*o/1e3}},window.onload=init,document.addEventListener("DOMContentLoaded",DOMLoaded);