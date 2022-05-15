/* Polyfill service v3.111.0
 * Disable minification (remove `.min` from URL path) for more info
 * This is the polyfill for includes() */
(function(self, undefined) {function Call(t,l){var n=arguments.length>2?arguments[2]:[];if(!1===IsCallable(t))throw new TypeError(Object.prototype.toString.call(t)+"is not a function.");return t.apply(l,n)}function Get(n,t){return n[t]}function IsCallable(n){return"function"==typeof n}function SameValueNonNumber(e,n){return e===n}function ToObject(e){if(null===e||e===undefined)throw TypeError();return Object(e)}function GetV(t,e){return ToObject(t)[e]}function GetMethod(e,n){var r=GetV(e,n);if(null===r||r===undefined)return undefined;if(!1===IsCallable(r))throw new TypeError("Method not callable: "+n);return r}function Type(e){switch(typeof e){case"undefined":return"undefined";case"boolean":return"boolean";case"number":return"number";case"string":return"string";case"symbol":return"symbol";default:return null===e?"null":"Symbol"in self&&(e instanceof self.Symbol||e.constructor===self.Symbol)?"symbol":"object"}}function OrdinaryToPrimitive(r,t){if("string"===t)var e=["toString","valueOf"];else e=["valueOf","toString"];for(var i=0;i<e.length;++i){var n=e[i],a=Get(r,n);if(IsCallable(a)){var o=Call(a,r);if("object"!==Type(o))return o}}throw new TypeError("Cannot convert to primitive.")}function SameValueZero(n,e){return Type(n)===Type(e)&&("number"===Type(n)?!(!isNaN(n)||!isNaN(e))||(1/n===Infinity&&1/e==-Infinity||(1/n==-Infinity&&1/e===Infinity||n===e)):SameValueNonNumber(n,e))}function ToInteger(n){if("symbol"===Type(n))throw new TypeError("Cannot convert a Symbol value to a number");var t=Number(n);return isNaN(t)?0:1/t===Infinity||1/t==-Infinity||t===Infinity||t===-Infinity?t:(t<0?-1:1)*Math.floor(Math.abs(t))}function ToLength(n){var t=ToInteger(n);return t<=0?0:Math.min(t,Math.pow(2,53)-1)}function ToPrimitive(e){var t=arguments.length>1?arguments[1]:undefined;if("object"===Type(e)){if(arguments.length<2)var i="default";else t===String?i="string":t===Number&&(i="number");var r="function"==typeof self.Symbol&&"symbol"==typeof self.Symbol.toPrimitive?GetMethod(e,self.Symbol.toPrimitive):undefined;if(r!==undefined){var n=Call(r,e,[i]);if("object"!==Type(n))return n;throw new TypeError("Cannot convert exotic object to primitive.")}return"default"===i&&(i="number"),OrdinaryToPrimitive(e,i)}return e}function ToString(t){switch(Type(t)){case"symbol":throw new TypeError("Cannot convert a Symbol value to a string");case"object":return ToString(ToPrimitive(t,String));default:return String(t)}}!function(e){var t=Object.prototype.hasOwnProperty.call(Object.prototype,"__defineGetter__"),r="A property cannot both have accessors and be writable or have a value";Object.defineProperty=function n(o,i,f){if(e&&(o===window||o===document||o===Element.prototype||o instanceof Element))return e(o,i,f);if(null===o||!(o instanceof Object||"object"==typeof o))throw new TypeError("Object.defineProperty called on non-object");if(!(f instanceof Object))throw new TypeError("Property description must be an object");var c=String(i),a="value"in f||"writable"in f,p="get"in f&&typeof f.get,s="set"in f&&typeof f.set;if(p){if(p===undefined)return o;if("function"!==p)throw new TypeError("Getter must be a function");if(!t)throw new TypeError("Getters & setters cannot be defined on this javascript engine");if(a)throw new TypeError(r);Object.__defineGetter__.call(o,c,f.get)}else o[c]=f.value;if(s){if(s===undefined)return o;if("function"!==s)throw new TypeError("Setter must be a function");if(!t)throw new TypeError("Getters & setters cannot be defined on this javascript engine");if(a)throw new TypeError(r);Object.__defineSetter__.call(o,c,f.set)}return"value"in f&&(o[c]=f.value),o}}(Object.defineProperty);function CreateMethodProperty(e,r,t){var a={value:t,writable:!0,enumerable:!1,configurable:!0};Object.defineProperty(e,r,a)}CreateMethodProperty(Array.prototype,"includes",function e(r){"use strict";var t=ToObject(this),o=ToLength(Get(t,"length"));if(0===o)return!1;var n=ToInteger(arguments[1]);if(n>=0)var a=n;else(a=o+n)<0&&(a=0);for(;a<o;){var i=Get(t,ToString(a));if(SameValueZero(r,i))return!0;a+=1}return!1});})('object' === typeof window && window || 'object' === typeof self && self || 'object' === typeof global && global || {});



window.burgersThrown = [];

function showBurgerThrow(id)
{
	createBurger(id);
	var childEl = document.createElement('img');
	childEl.src = 'i/icon_burger.gif';
	childEl.id = 'throw_burger_' + id;
	childEl.style.opacity = 1.0;
	childEl.style.position = 'absolute';
	childEl.style.width = 2 + '%';
	childEl.style.left = 49 + '%';
	childEl.style.top = 34 + '%';
	childEl.style.height = 2 + '%';
	childEl.style.zIndex = 1000;
	childEl.style.display = 'none';
	
	document.getElementById('contenttop').appendChild(childEl);
	
	setTimeout("document.getElementById('throw_burger_"+id+"').style.display='block'; updateBurgerThrow("+id+",0);", 300 + Math.random() * 800);
}

function updateBurgerThrow(id, i)
{
	var max = 30;
	i = parseInt(i);
	var burgerEl = document.getElementById('throw_burger_' + id);
	if(i > max * 0.75)
	{
		burgerEl.parentNode.removeChild(burgerEl);
		showBurgerBurst(id);
		return;
	}
	burgerEl.style.top = 34 - i/max * (34 - 5) + '%';
	burgerEl.style.height = 2 + i/max * 58 + '%';
	burgerEl.style.width = 2 + i/max * 74 + '%';
	burgerEl.style.left = 49 - i/max * (49 - 12) + '%';
	setTimeout("updateBurgerThrow(" + id + "," + (i+1)+ ");", 20);
}


function showBurgerBurst(id)
{
	showBurger(id);
	
	setTimeout("updateBurgerBurst("+id+",0);", 0);
}

function updateBurgerBurst(id, i)
{
	var max = 30;
	var midPoint = max/2;
	i = parseInt(i);
	var burgerEl = document.getElementById('burger_' + id);
	if(i > max)
	{
		//burgerEl.parentNode.removeChild(burgerEl);
		setTimeout("updateBurger("+id+",0);", 1000);
		return;
	}
	var growth = 5;
	var percentage = (midPoint - Math.abs(midPoint - i))/midPoint;
	burgerEl.style.width = percentage * growth + 76 + '%';
	burgerEl.style.left = 12 - (percentage * growth)/2 + '%';
	burgerEl.style.top = 5 - (percentage * growth)/2 + '%';
	burgerEl.style.height = percentage * growth + 60 + '%';
	setTimeout("updateBurgerBurst(" + id + "," + (i+1)+ ");", 20);
}

function createBurger(id)
{
	var childEl = document.createElement('img');
	childEl.src = 'i/icon_burger.gif';
	childEl.id = 'burger_' + id;
	childEl.style.opacity = 1.0;
	childEl.style.position = 'absolute';
	childEl.style.width = 76 + '%';
	childEl.style.left = 12 + '%';
	childEl.style.top = 5 + '%';
	childEl.style.height = 60 + '%';
	childEl.style.zIndex = 1000;
	childEl.style.display = 'none';
	
	document.getElementById('contenttop').appendChild(childEl);
}

function showBurger(id)
{
	document.getElementById('burger_' + id).style.display = 'block';
}

function updateBurger(id, i)
{
	var max = 150;
	var fadeStart = 75;
	i = parseInt(i);
	var burgerEl = document.getElementById('burger_' + id);
	if(i > max)
	{
		burgerEl.parentNode.removeChild(burgerEl);
		return;
	}
	burgerEl.style.opacity = Math.min(1, ((max - fadeStart) - (i - fadeStart))/(max - fadeStart));
	burgerEl.style.top = 5 + i/max * 30 + '%';
	burgerEl.style.height = 60 + i/max * 20 + '%';
	setTimeout("updateBurger(" + id + "," + (i+1)+ ");", 20);
}

var lastBurgerThrow = 0;
function throwBurger(id, who)
{
	
	if(id <= lastBurgerThrow && window.burgersThrown.includes(id))
	{
		// Burger already thrown
		return;
	} else {
		
		// console.log("burger throw: " + id);
		lastBurgerThrow = id;
	
		showBurgerThrow(id);
		window.burgersThrown.push(id);
	}
}