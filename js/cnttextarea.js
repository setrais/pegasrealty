/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// prototype-analog
function jcnt(obj) {
  	if (typeof obj == 'object')
  	return obj;
	if (document.getElementById)
		return (document.getElementById(obj));
	else  if (document.all) 
		return document.all(obj);

    return null;
}

// PHP str_replace-analog
String.prototype.str_replace = function(srch, rpl)
{
	var ar = this.split(srch);
	return ar.join(rpl);
}

// Узнаём родительский элемент
function getParent(el) {

	return ((el.parentElement) ? el.parentElement : ((el.parentNode) ? el.parentNode : null));

}

// Узнаём параметры элемента: ширину, высоту, а также координаты
function getElementPosition(el)
{
	
	w = el.offsetWidth;
	h = el.offsetHeight;
	
	l = t = 0;
	
	while (el)
	{
        	l += el.offsetLeft;
        	t += el.offsetTop;
        	el = el.offsetParent;
	}

	return {"left":l, "top":t, "width": w, "height":h};
}

function createTextAreaWidget(el, min, max, subs)
{
	var el = jcnt(el);
	var counter = jcnt('counter' + el.id);
	if (!counter)
	{
		var parent = getParent(el);
		var counter = document.createElement('div');
		counter.setAttribute('id', 'counter' + el.id);
		counter.className = 'counter';
		parent.appendChild(counter);
		parent.style.position = 'relative';
		counter.style.position = 'absolute';

		counter.style.left = getElementPosition(el).width + 162 +  'px';  //2 +  'px';
		counter.style.top = 2 + 'px'; // 0;
		counter.style.height = getElementPosition(el).height + 'px';
	}

	// перенос строки js принимает за два знака. Исправляем.
	len = el.value.str_replace(String.fromCharCode(13), '').length;
	if (len >= max) {
                if (subs) {
                    el.value = el.value.substr(0, max);
                }
		len = max;
	}

	el.onkeyup = function () {createTextAreaWidget(el, min, max, subs);}
	el.onchange = function () {createTextAreaWidget(el, min, max, subs);}
	createStat(counter, min, max, len);	

}

function createStat(el, min, max, current)
{
	el.innerHTML = '<span class=min>&lt; ' + min + '<\/span><br>';
	var className = (current <= min) ? 'gray' : ((current >= max) ? 'red' : 'normal');
	var cur = (current >= max) ? current + ' !!!' : current;
	el.innerHTML += '<span class=' + className + '>= ' + cur + '<\/span><br>';
	el.innerHTML += '<span class=max>&gt; ' + max + '<\/span>';
}


