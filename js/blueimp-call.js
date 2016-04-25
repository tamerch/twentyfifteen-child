document.getElementById('container').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
	//var target = event.target.parentNode.children[0] || event.srcElement,
        //link = target.src ? target.parentNode : target,
        link = target.parentNode,
		options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};