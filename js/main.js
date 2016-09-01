//- FUNCTION FOR SCROLL EVENTS 
//-------------------------------------------

if (document.querySelector('.trigger') != undefined) {
	window.onscroll = getScrollPosition;
}

function getScrollPosition(){
	var windowBottom = window.pageYOffset + window.innerHeight,
	object = document.querySelector('.trigger'), 
	objectBottom = object.offsetTop + parseInt(window.getComputedStyle(object).height);

	if (windowBottom > objectBottom - 200){
		object.classList.add('go');
	}
};

//- AJAX PROMISE TOOLS
//-------------------------------------------------

var tools = {
	siteUrl : '', 
	url : 'url',

	postRequest : function(url, data) { 
		var x = new XMLHttpRequest();
		return new Promise(function(resolve, reject){	
			x.open('POST', url, data); 
			x.onload = function() {
				if (this.status > 199 && this.status < 300) {
					resolve(this.response)
				}
				else {
					reject({
						status: this.status, 
						statusText: x.statusText
					}); 
				}
			}; 
			x.onError = function() {
				reject({
					status : this.status, 
					statusText : x.statusText 
				}); 
			}; 
			x.send(url, data);
		})
	}, 

	getRequest : function(url) {
		this.x.onreadystatechange = function(response){};
		this.x.open('GET', url || null); 
		this.x.send(null);
		return this.x;  
	}
}; 


//- IE FIX
//-------------------------------------------------

(function msiedetection() {
	var ie = window.navigator.userAgent.indexOf("MSIE ")
	// If Internet Explorer, return true
	if (ie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  {
		document.querySelector('html').classList.add('ie');
	}
	// If another browser, return false
	else  {
		console.log('thank you for not using ie')
		return false;
	}	
})();


//- FIREFOX FIX 
//-------------------------------------------------

if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
	document.querySelector('html').classList.add('firefox')
}
