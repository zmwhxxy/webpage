var aImg = null;

function toDou(n) {
	if (n < 10) {
		return '0' + n;
	}
	return '' + n;
}

function showTime() {
	var oDate = new Date();
	var str = toDou(oDate.getHours()) + toDou(oDate.getMinutes()) + toDou(oDate.getSeconds());
	for (var i = 0; i < aImg.length; i++) {
		aImg[i].src = 'img/' + str.charAt(i) + '.png';
	}
}

window.onload = function () {
	aImg = document.getElementsByTagName('img');
	showTime();
	setInterval(showTime, 1000);
	
}

