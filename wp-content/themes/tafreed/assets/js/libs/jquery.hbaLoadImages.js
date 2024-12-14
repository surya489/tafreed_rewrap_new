/*
 jquery.loadImages.js v1.0
 @author Jaya Surya
*/
(function (d) { d.fn.hbaLoadImages = function (h) { var a = d.extend({}, { total: 0, completed: 0, selector: "img", attribute: "src", debug: !1, onSuccess: null, onError: null, onComplete: null, onQueueComplete: null }, h), e = { init: function (a, c) { var b = d(a); "IMG" !== a.tagName && (b = d(a).find(c.selector), c.total = b.length); c.completed = 0; b.each(function () { var a = this, b = d(a).attr(c.attribute), f = new Image; if ("IMG" !== this.tagName) e.trigger.onError("The element must be used only with a IMG tag.", "", a); else if ("undefined" == typeof b) e.trigger.onError("Source attribute was not found.", "", a); else if ("" == d.trim(b)) e.trigger.onSuccess("", a); else if (f.src = b, f.complete || 4 === f.readystate) e.trigger.onSuccess(b, a); else f.onload = function () { e.trigger.onSuccess(b, a) }, f.onerror = function () { e.trigger.onError("Unable to load the image.", b, a) } }) }, trigger: { onSuccess: function (b, c) { if (d.isFunction(a.onSuccess)) a.onSuccess(b, c); e.trigger.onComplete(b, c) }, onError: function (b, c, g) { !0 === a.debug && console.log(b); if (d.isFunction(a.onError)) a.onError(b, c, g); e.trigger.onComplete(c, g) }, onComplete: function (b, c) { a.completed += 1; if (d.isFunction(a.onComplete)) a.onComplete(b, c); if (a.completed === a.total) e.trigger.onQueueComplete() }, onQueueComplete: function () { if (d.isFunction(a.onQueueComplete)) a.onQueueComplete() } } }; a.total = 0; this.each(function () { a.total += 1 }); this.each(function () { e.init(this, a) }); return this } })(jQuery);