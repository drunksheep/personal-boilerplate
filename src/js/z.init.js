
function init() {
    
}

// window load binds 
window.onload = init;

function DOMLoaded() {
    // these are not always necessary but sometimes they fuck with ya
    if (helpers.iOS) {
        document.querySelector('html').classList.add('ios');
    } else if (helpers.IE()) {
        document.querySelector('html').classList.add('ie');
    }
}

// domcontent binds 
document.addEventListener('DOMContentLoaded', DOMLoaded);