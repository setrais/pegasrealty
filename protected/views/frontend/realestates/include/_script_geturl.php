<script>
    
/* функция меняет содержимое адресной строки
   в "крутых" броузерах я решил использовать history.replaceState
   см. http://www.mokrushin.net/post/html5-history-object/)
   для остальных используем document.location.hash */
function changeBrowserUrl(url) {
    var url = url.split("?");
    var j = 0;
    if (url[1]) {
        var query = new Array();
        var params = url[1].split("&");
        var del = true;
        for (i in params) {
            var param = params[i].split("=");
            // удаляем параметр ajax, т. к. он не должен передаваться в ссылке
            if (param[0]=="ajax") {
                continue;
            }
            if (param[0].split(encodeURIComponent("[]")).length>1) {
            //if (param[0]=="metro"+encodeURIComponent("[]")) { 
                if (param[1]!=='') {
                    name = param[0].replace(encodeURIComponent("Realestates["),"").replace(encodeURIComponent("][]"),"").replace(encodeURIComponent("[]"),"");                               
                    if (typeof query[name]=="undefined") {
                      query[name] = param[1];                       
                    } else { 
                      /*if (query[name]===param[1]) {  !@TODO DOOBLE 
                        query[name] = param[1];  
                      }else{*/
                        query[name] = query[name]+','+param[1];    
                      /*}*/  
                    }
                } 
            }else{
                query[param[0]] = param[1];
            }    
        }
    }
    if (history.replaceState) {
        history.replaceState({}, "", buildUrl(url[0], query));
    } else {
        window.location.hash='#'+buildUrl(url[0], query);
    }
    return buildUrl(url[0], query);
}

// функция-аналог http_build_query в PHP
function buildUrl(url, parameters){
    var qs = "";
    var fresh ;
    for(var key in parameters) {        
        var value = parameters[key];   
        //if (key!=='property' || key!=='pid') {
            if (value.length>0) { // Убираем пустые параметры
                if (value.indexOf(',')>=0) { // Проверяем на множество           
                    fresh = array_unique(decodeURIComponent(value).split(',')); // Убирем дубляжи
                    qs += key + "=" + /*encodeURIComponent(*/fresh.join(',')/*)*/ + "&"; // Переводим массив в строку                        
                } else {
                    qs += key + "=" + /*encodeURIComponent(*/value/*)*/ + "&"; 
                }    
            }
        //}
    }
    if (qs.length > 0){
        qs = qs.substring(0, qs.length-1);
        url = url + "?" + qs;
    }
    return url;
}

function array_unique(inArr){
  var uniHash={}, outArr=[], i=inArr.length;
  while(i--) uniHash[inArr[i]]=i;
  for(i in uniHash) outArr.push(i);
  return outArr
}

/* Делаем редирект, если в hash имеется текст,
   начинающийся с / (т. е. потенциальная ссылка)*/
$(function() {
    var url = window.location.hash.split("#")[1];
    if (url && url[0]=='/') {
        window.location = url;
    }
})

</script>