function searchIdEvent(){
  var id=$("#searchId").val();
  id=id.replace(/,/, 's').replace(/\\./, 's');
  if(parseInt(id)>0&&parseInt(id)==id){
    //$('#searchIdForm').submit();
    return true;
  }else{
    $("#searchId").addClass('error');
    
    $("#searchId").keydown(function(){
      $(this).removeClass('error');
    }).focus(function(){
      $(this).removeClass('error');
    });
    
    return false;
  }
  return false;
}
/*function searchId(){
    return searchIdEvent();
}*/

function setCookie(c_name,value,expiredays)
{
  var exdate=new Date();
  exdate.setDate(exdate.getDate()+expiredays);
  document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}

/* Moscow metro map */
var metroMap = {
	lines : {
		'koltsevaya' : new Array(116, 109, 51, 115, 158, 80, 66, 134, 107, 18, 70,62),
		'filevskaya' : new Array(62, 78, 123, 177, 14, 178, 81, 155, 7, 48, 94, 1514, 1513),
		'arbatsko-pokrovskaya' : new Array(1581, 1583, 1582, 154, 97, 75, 78, 190, 119, 56, 118, 145, 192, 16, 80, 125, 11, 147, 62, 117, 1507),
		'sokolnicheskaya' : new Array(173, 183, 130, 149, 71, 66, 72, 186, 85, 113, 22, 74, 116, 179, 151, 43, 176, 133, 193),
		'kaluzhsko-rizhskaya' : new Array(93, 13, 142, 27, 37, 8, 138, 134, 156, 168, 63, 164, 109, 189, 83, 6, 132, 108, 57, 19, 67, 162, 196, 25),
		'serpuhovsko-timiryazevskaya' : new Array(9, 21, 112, 38, 121, 163, 50, 141, 95, 182, 185, 26, 128, 146, 167, 98, 99, 100, 143, 184, 194, 129, 171, 10, 29),
		'kahonovskaya' : new Array(61, 36, 60),
		'zamoskvoretskaya' : new Array(137, 39, 40, 148, 12, 49, 18, 92, 159, 160, 104, 115, 5, 65, 61, 58, 181, 111, 52, 69),
		'lyublinskaya' : new Array(166, 152, 187, 139, 73, 53, 64, 122, 42, 31, 90, 87),
		'tagansko-krasnopresnenskaya' : new Array(126, 157, 169, 191, 110, 127, 17, 170, 15, 135, 76, 63, 158, 131, 41, 161, 77, 140, 44, 131),
		'kalininskaya' : new Array(102, 120, 188, 4, 124, 88, 164),
		'butovskaya' : new Array(175, 174, 28, 172, 32),
		'center' : new Array( 22, 1513, 1514, 7,11,26,63,72,74,76,85,92,104,113,125,128,135,147,152,156,159,160,164,166,168,182,185,186	),
		'centerplus' : new Array( 7,11,26,63 ,72,74,76,85,92, 104, 113, 125, 128,135, 147, 152, 156,159, 160, 164, 166,168, 182, 185, 186,116, 109, 51, 115, 158,80, 66,134,107, 18, 70, 62, 179, 189,146,167,5, 131,73, 139,124,88, 187, 95, 15, 1513, 1514, 74, 76, 22, 141, 138,16, 4, 71, 49,170, 48,155, 117	)
	},
	
	parts : {
		'uygozapadnaya' : new Array(193, 133, 176, 43, 151, 179),
		'bitzevskiy_park' : new Array(25, 196, 162, 67, 19, 57, 108, 132, 6, 83, 189),
		'bulvar_dm_donskogo' : new Array(29, 10, 171, 129, 194, 184,  143, 100, 99, 98, 167),
		'kahonovskaya' : new Array(60, 36, 61),
		'krasnogvardeyskaya' : new Array(69, 52, 111, 181, 58, 61, 65, 5),
		'marino' : new Array(90, 31, 87, 42, 122, 64, 53, 73, 139),
		'vihino' : new Array(44, 140, 77, 161, 41, 131),
		'novokosino' : new Array(102, 120, 188, 4, 124),
		'szhelkovskaya' : new Array(190, 119, 56, 118, 145, 192, 16),
		'podbelskogo' : new Array(173, 183, 130, 149, 71),
		'medvedkovo' : new Array(93, 13, 142, 27, 37, 8, 138),
		'altufevo' : new Array(9, 21, 112, 38, 121, 163, 50, 141),
		'trubnaya' : new Array(166, 152),
		'rechnoy_vokzal' : new Array(137, 39, 40, 148, 12, 49),
		'planernaya' : new Array(126, 157, 169, 191, 110, 127, 17, 170),
		'mezhdunarodnaya' : new Array(94, 48),
		'mezhdunarodnaya1' : new Array(155, 81, 178, 123, 14, 177, 78),
		'mitino' : new Array(1581, 1583, 1582, 154, 75, 97, 117, 78, 1507)
	},
	
	regions : {
		'197' : new Array(102, 120, 188, 190, 119, 56, 145, 192, 173, 183, 130, 149, 44, 118),
		'198' : new Array(62, 117, 133, 193, 75, 97, 78, 123, 177, 14, 178, 81, 155, 1507),
		'199' : new Array(137, 39, 40, 148, 12, 49, 127, 17, 121, 163),
		'200' : new Array(37, 93, 13, 142, 27, 8, 9, 21,112, 38, 50, 141),
		'201' : new Array(126, 1581, 1583, 1582, 154, 157, 169, 191, 110),
		'202' : new Array(138, 134, 152, 156, 168, 177, 63, 164, 109, 18, 92, 159, 160, 104, 115, 124, 139, 88, 16, 80, 187, 125, 11, 147, 1514, 94, 48, 1513, 71, 66, 72, 186, 85, 113, 22, 116, 179, 151, 43, 74, 7, 158, 51, 70, 107, 170, 15, 135, 76, 131, 73, 166, 95, 182, 185, 26, 128, 146),
		'203' : new Array(189, 5, 65, 61, 58, 181, 111, 52, 69, 36, 167, 98, 99, 194, 129, 171, 10),
		'204' : new Array(4, 41, 161, 77, 140, 53, 64, 122, 42, 87, 31, 90),
		'205' : new Array(83, 6, 132, 108, 57, 19, 67, 162, 196, 25, 60, 176, 100, 143, 184, 29, 28, 172, 174, 175, 32)
	},
	
	districts : {
		'197' : new Array(45,68,103,195),
		'198' : new Array(91,101,105,114,136,150,165),
		'199' : new Array(20,33,46,47,180),
		'200' : new Array(84,144),
		'201' : new Array(79,96,153),
		'202' : new Array(),
		'203' : new Array(23,24,30),
		'204' : new Array(54,59,86,89),
		'205' : new Array(34,35),
		'n_himki' : new Array('106'),
		'n_zelenograd' : new Array('55')
		
	},
		
	adjacent : {
		// Р‘Р°СЂСЂРёРєР°РґРЅР°СЏ - РљСЂР°СЃРЅРѕРїСЂРµСЃРЅРµРЅСЃРєР°СЏ
		15: new Array('70'),
		70: new Array('15'),

		// РњРµРЅРґРµР»РµРµРІСЃРєР°СЏ - РќРѕРІРѕСЃР»РѕР±РѕРґСЃРєР°СЏ
		95: new Array('107'),
		107: new Array('95'),
		
		// РљСѓСЂСЃРєР°СЏ - Р§РєР°Р»РѕРІСЃРєР°СЏ
		80: new Array('187'),
		187: new Array('80'),
		
		// Р”РѕР±СЂС‹РЅРёРЅСЃРєР°СЏ - РЎРµСЂРїСѓС…РѕРІСЃРєР°СЏ
		51: new Array('146'),
		146: new Array('51'),
		
		// РђР»РµРєСЃР°РЅРґСЂРѕРІСЃРєРёР№ СЃР°Рґ - Р‘РёР±Р»РёРѕС‚РµРєР° РёРј. Р›РµРЅРёРЅР° - РђСЂР±Р°С‚СЃРєР°СЏ - Р‘РѕСЂРѕРІРёС†РєР°СЏ
		7: new Array('11', '22', '26'),
		11: new Array('7', '22', '26'),
		22: new Array('7', '11', '26'),
		26: new Array('7', '11', '22'),
	
		// РћС…РѕС‚РЅС‹Р№ СЂСЏРґ - РўРµР°С‚СЂР°Р»СЊРЅР°СЏ - РџР»РѕС‰Р°РґСЊ СЂРµРІРѕР»СЋС†РёРё
		113: new Array('125', '160'),
		125: new Array('113', '160'),
		160: new Array('113', '125'),
		
		// Р§РёСЃС‚С‹Рµ РїСЂСѓРґС‹ - РЎСЂРµСЃС‚РёРЅСЃРєРёР№ Р±СѓР»СЊРІР°СЂ - РўСѓСЂРіРµРЅРµРІСЃРєР°СЏ
		152: new Array('168', '186'),
		168: new Array('152', '186'),
		186: new Array('152', '168'),
		
		// РљСѓР·РЅРµС†РєРёР№ РјРѕСЃС‚ - Р›СѓР±СЏРЅРєР°
		76: new Array('85'),
		85: new Array('76'),
		
		// РўСЂРµС‚СЊСЏРєРѕРІСЃРєР°СЏ - РќРѕРІРѕРєСѓР·РЅРµС†РєР°СЏ
		104: new Array('164'),
		164: new Array('104'),
		
		// Р¦РІРµС‚РЅРѕР№ Р±СѓР»СЊРІР°СЂ - РўСЂСѓР±РЅР°СЏ
		166: new Array('182'),
		182: new Array('166'),
	
		// РўРІРµСЂСЃРєР°СЏ - РџСѓС€РєРёРЅСЃРєР°СЏ - Р§РµС…РѕРІСЃРєР°СЏ
		135: new Array('159', '185'),
		159: new Array('135', '185'),
		185: new Array('135', '159'),
		
		// РЎРµРІР°СЃС‚РѕРїРѕР»СЊСЃРєР°СЏ - РљР°С…РѕРІСЃРєР°СЏ
		60: new Array('143'),
		143: new Array('60'),
		
		// Р‘СѓР»СЊРІР°СЂ Р”Рј.Р”РѕРЅСЃРєРѕРіРѕ - РЈР»РёС†Р° РЎС‚Р°СЂРѕРєР°С‡Р°Р»РѕРІСЃРєР°СЏ
		29: new Array('175'),
		175: new Array('29'),
		
		// РџР»РѕС‰Р°РґСЊ пїЅ?Р»СЊРёС‡Р° - Р РёРјСЃРєР°СЏ
		124: new Array('139'),
		139: new Array('124'),
		
		// РљСЂРµСЃС‚СЊСЏРЅСЃРєР°СЏ Р·Р°СЃС‚Р°РІР° - РџСЂРѕР»РµС‚Р°СЂСЃРєР°СЏ
		73: new Array('131'),
		131: new Array('73'),

		// РњР°СЂРєСЃРёСЃС‚СЃРєР°СЏ - РўР°РіР°РЅСЃРєР°СЏ
		88: new Array('158'),
		158: new Array('88')
	},
	
	selectedStantions : new Array(),
	selectedLines : new Array(),
	selectedRegions : new Array(),
	selectedDistricts : new Array(),
	allStantions : new Array(),
	allDistricts : new Array(),
	
/* SPECIALS METHODS */
	inArray : function(needle, array){
		var found = false, key;
		for (key in array) {
			if (typeof(array[key])=='function') continue;
			if (array[key]==needle) {
				found=true;
				break;
			}
		}
		return found;
	},
	
	arraySearch : function(needle, array){
		var index = false, key;
		for (key in array) {
			if (typeof(array[key])=='function') continue;
			if (array[key]==needle) {
				index = key;
				break;
			}
		}
		return index;
	},
	
/* GENERAL */
	init : function(){
		var key,keyIn;
		for (key in this.districts) {
			if (typeof(this.districts[key])=='function') continue;
			this.allDistricts.push(key);
			for (keyIn in this.districts[key]) {
				if (typeof(this.districts[key][keyIn])=='function') continue;
				this.allDistricts.push(this.districts[key][keyIn]);
			}
		}
		for (key in this.lines) {
			if (typeof(this.lines[key])=='function') continue;
			for (keyIn in this.lines[key]) {
				if (typeof(this.lines[key][keyIn])=='function') continue;
				this.allStantions.push(this.lines[key][keyIn]);
			}
		}
	},
	
	loadAndOpen : function(){
		var ids, key, cDialog, oPopupsOuter;
		this.reset();
		if (this.allStantions.length<10) {
			this.init();
		}
		if (currentRegionSelected==MoscowRegionId){
			ids=selectedFilterRegions;
			popupElShow('idPopupMap');			
			for (key in ids) {
				if (typeof(ids[key])=='function') continue;
				if (this.regions[ids[key]]) {
					this.regionSelect(ids[key])	
				} else if (this.inArray(ids[key],this.allDistricts)){
					this.districtSelect(ids[key]);
				} else if (this.inArray(ids[key],this.allStantions)){
					this.stantionSelect(ids[key], false, true);
				}
			}
						
		}
	
	},
	
	save : function(){
		var ids,key;
		ids = this.selectedDistricts.concat(this.selectedStantions);
		selectedFilterRegions=ids;
	},
	
	
	reset : function(){
		var key;
		if (this.selectedRegions.length>0){
			while (this.selectedRegions[0]){
				this.regionUnSelect(this.selectedRegions[0]);
			}
		}
		if (this.selectedDistricts.length>0){
			while (this.selectedDistricts[0]){
				this.districtUnSelect(this.selectedDistricts[0]);
			}
		}
		if (this.selectedStantions.length>0){
			while (this.selectedStantions[0]){
				this.stantionUnSelect(this.selectedStantions[0]);
			}
		}
	},
	
/* STANTIONS */
	isStantionSelected : function(stantion){
		return this.inArray(stantion,this.selectedStantions);
	},

	stantionSelect : function(stantion, disableReCalculate, noAdjacent){ 
		var key, lines=new Array(), line;
		if (!this.isStantionSelected(stantion)) {
			this.selectedStantions.push(stantion);
			this.printStantionSelect(stantion);
			if (!noAdjacent) {
				if (typeof(this.adjacent[stantion]) != 'undefined') {
					for (var i = 0; i < this.adjacent[stantion].length; ++i) {
						this.selectedStantions.push(this.adjacent[stantion][i]);
						this.printStantionSelect(this.adjacent[stantion][i]);
					}
				}
			}
			if (!disableReCalculate) {
				lines=this.getLinesByStantion(stantion);
				for (key in lines) {
					if (typeof(lines[key])=='function') continue;
					line=lines[key];
					if (line && this.isFullLineSelected(line)) {
						this.lineSelect(line,true);
					}
				}
			}
			return true;
		} else {
			return false;
		}
	},
	
  save : function(){  

		
		
		html_text = '';
		html_text2 = '';
		
		var sel_count = 0;
		
		for( Index = 0; Index < this.selectedStantions.length; Index++ ) {

			html_item = '<li id="selmetro_' + this.selectedStantions[ Index ] + '" ><input type="hidden" name="metro[]" value="' + this.selectedStantions[ Index ] + '" ><a href="javascript: RemoveMetro( ' + this.selectedStantions[ Index ] + ' )" >' + this.getPrintStantionLink( this.selectedStantions[ Index ] ).alt + '</a> </li>';
							
			if ( sel_count <= 3 ) {
				html_text = html_text + html_item;
			} else {
				html_text = html_text + html_item;
			}
			
			
			sel_count =  sel_count + 1;
			
		}
		
		
		jQuery( "#metro" ).html( html_text );
		//jQuery( "#metro2" ).html( html_text2 );
		
		jQuery( "div.metroblock" ).show();
		jQuery( "#metro_switch_box" ).show();
		jQuery( "#metroblock_hr" ).show();
		
	},

    
	stantionUnSelect : function(stantion, disableReCalculate){  
		var key, line;
		if (this.isStantionSelected(stantion)) {
			this.selectedStantions.splice(this.arraySearch(stantion,this.selectedStantions),1);
			this.printStantionUnSelect(stantion);
			if (!disableReCalculate) {
				lines=this.getLinesByStantion(stantion);
				for (key in lines) {
					if (typeof(lines[key])=='function') continue;
					line=lines[key];
					if (line && !this.isFullLineSelected(line)) {
						this.lineUnSelect(line,true);
					}
				}
			}
			return true;
		} else {
			return false;
		}
	},
	
	stantionSwitch : function(stantion){
		if (this.isStantionSelected(stantion)) {
			this.stantionUnSelect(stantion);
		} else {
			this.stantionSelect(stantion);
		}
	},
	
	isStantionOnLine : function(stantion,line){
		if (this.lines[line] && this.inArray(stantion,this.lines[line])) {
			return true;
		} else {
			return false;
		}	
	},
	
		
/* LINES */
	isLineSelected : function(line){
		return this.inArray(line,this.selectedLines);
	},

	lineSelect : function(line, disableReCalculate){
		if (!this.isLineSelected(line)) {
			this.printLineSelect(line);
			this.selectedLines.push(line);
			if (!disableReCalculate){
				this.lineStantionsSelect(line);
			}
			return true;
		} else {
			return false;
		}
	
	},
	
	lineUnSelect : function(line, disableReCalculate){
		if (this.isLineSelected(line)) {
			this.printLineUnSelect(line);
			this.selectedLines.splice(this.arraySearch(line,this.selectedLines),1);
			if (!disableReCalculate){
				this.lineStantionsUnSelect(line);
			}
			return true;
		} else {
			return false;
		}
	},
	
	lineSwitch : function(line){
		if (this.isLineSelected(line)) {
			this.lineUnSelect(line);
		} else {
			this.lineSelect(line);
		}
	},
	
	getLinesByStantion : function(stantion){
		var key, lines=false;
		for (key in this.lines){
			if (typeof(this.lines[key])=='function') continue;
			if (this.isStantionOnLine(stantion,key)){
				if (!lines) {
					lines = new Array();
				}
				lines.push(key);
			}
		}
		return lines;
	},
	
	isFullLineSelected : function(line){
		var full=false, key;
		if (this.lines[line]) {
			full=true;
			for (key in this.lines[line]){
				if (typeof(this.lines[line][key])=='function') continue;
				if (!this.isStantionSelected(this.lines[line][key])){
					full=false;
					break;
				}
			}
		}
		return full;
	},
	
	isEmptyLineSelected : function(line){
		var empty=false, key;
		if (this.lines[line]) {
			empty=true;
			for (key in this.lines[line]){
				if (typeof(this.lines[line][key])=='function') continue;
				if (this.isStantionSelected(this.lines[line][key])){
					empty=false;
					break;
				}
			}
		}
		return empty;
	},
	
	lineStantionsSelect : function(line){
		var key;
		if (this.lines[line]) {
			for (key in this.lines[line]) {
				if (typeof(this.lines[line][key])=='function') continue;
				this.stantionSelect(this.lines[line][key],true,true);
			}
		}
	},
	
	lineStantionsUnSelect : function(line){
		var key, stantion, lines, keyIn, countSelected;
		if (this.lines[line]) {
			for (key in this.lines[line]){
				if (typeof(this.lines[line][key])=='function') continue;
				stantion=this.lines[line][key];
				if (this.isStantionSelected(stantion)) {
					lines = this.getLinesByStantion(stantion);
					countSelected=0;
					for (keyIn in lines) {
						if (typeof(lines[keyIn])=='function') continue;
						if (this.isLineSelected(lines[keyIn])){
							countSelected++;
						}
					}
					if (countSelected<2) {
						this.stantionUnSelect(this.lines[line][key],true);
					}
				}
			}
		}
	},
	
/* PART OF LINES */	
	
	isFullPartSelected : function(part){
		var full=false, key;
		if (this.parts[part]) {
			full=true;
			for (key in this.parts[part]){
				if (typeof(this.parts[part][key])=='function') continue;
				if (!this.isStantionSelected(this.parts[part][key])){
					full=false;
					break;
				}
			}
		}
		return full;
	},
	
	partStantionsSelect : function(part){
		var key;
		if (this.parts[part]) {
			for (key in this.parts[part]){
				if (typeof(this.parts[part][key])=='function') continue;
				this.stantionSelect(this.parts[part][key]);
			}
		}
	},
	
	partStantionsUnSelect : function(part){
		var key;
		if (this.parts[part]) {
			for (key in this.parts[part]){
				if (typeof(this.parts[part][key])=='function') continue;
				this.stantionUnSelect(this.parts[part][key]);
			}
		}
	},
	
	partStantionsSwitch : function(part){
		if (this.isFullPartSelected(part)) {
			this.partStantionsUnSelect(part);	
		} else {
			this.partStantionsSelect(part);
		}
	},
	
	


/* REGIONS */
	isRegionSelected : function(region){
		return this.inArray(region,this.selectedRegions);
	},

	regionSelect : function(region, disableReCalculate){
		if (!this.isRegionSelected(region)) {
			this.selectedRegions.push(region);
			if (!disableReCalculate){
				this.regionStantionsSelect(region);
				this.regionDistrictsSelect(region);
			}
			return true;
		} else {
			return false;
		}
	
	},
	
	regionUnSelect : function(region, disableReCalculate){
		if (this.isRegionSelected(region)) {
			this.selectedRegions.splice(this.arraySearch(region,this.selectedRegions),1);
			if (!disableReCalculate){
				this.regionStantionsUnSelect(region);
				this.regionDistrictsUnSelect(region);
			}
			return true;
		} else {
			return false;
		}
	},
	
	regionSwitch : function(region){
		if (this.isRegionSelected(region)) {
			this.regionUnSelect(region);
		} else {
			this.regionSelect(region);
		}
	},
	
	regionStantionsSelect : function(region){
		var key;
		if (this.regions[region]) {
			for (key in this.regions[region]) {
				if (typeof(this.regions[region][key])=='function') continue;
				this.stantionSelect(this.regions[region][key]);
			}
		}
	},
	
	regionStantionsUnSelect : function(region){
		var key;
		if (this.regions[region]) {
			for (key in this.regions[region]){
				if (typeof(this.regions[region][key])=='function') continue;
				this.stantionUnSelect(this.regions[region][key]);
			}
		}
	},
	
	regionDistrictsSelect : function(region){
		var key;
		if (this.districts[region]) {
			for (key in this.districts[region]) {
				if (typeof(this.districts[region][key])=='function') continue;
				this.districtSelect(this.districts[region][key]);
			}
		}
		this.districtSelect(region);
	},
	
	regionDistrictsUnSelect : function(region){
		var key;
		if (this.districts[region]) {
			for (key in this.districts[region]){
				if (typeof(this.districts[region][key])=='function') continue;
				this.districtUnSelect(this.districts[region][key]);
			}
		}
		this.districtUnSelect(region);
	},


/* DISTRICTS */
	isDistrictSelected : function(district){
		return this.inArray(district,this.selectedDistricts);
	},

	districtSelect : function(district){
		if (!this.isDistrictSelected(district)) {
			this.printDistrictSelect(district);
			this.selectedDistricts.push(district);
			return true;
		} else {
			return false;
		}
	
	},
	
	districtUnSelect : function(district){
		if (this.isDistrictSelected(district)) {
			this.printDistrictUnSelect(district);
			this.selectedDistricts.splice(this.arraySearch(district,this.selectedDistricts),1);
			return true;
		} else {
			return false;
		}
	},
	
	districtSwitch : function(district){
		if (this.isDistrictSelected(district)) {
			this.districtUnSelect(district);
		} else {
			this.districtSelect(district);
		}
	},
	
	
/* PRINTS */

	gE : function(elementId){
		if (document.getElementById(elementId)) {
			return document.getElementById(elementId);
		} else {
			return false;
		}
	},
	
	addStantionText : function(stantion) {
		var area;
		area = this.gE('stantions_text');
		if (!this.gE('stantionText_'+stantion)) {
			area.innerHTML+='<span id="stantionText_'+stantion+'"> <a href="#" onclick="metroMap.stantionUnSelect(\''+stantion+'\'); return false;">'+this.getPrintStantionLink(stantion).alt+'</a></span>';
		}
	},
	
	removeStantionText : function(stantion) {
		var area;
		area = this.gE('stantions_text');
		if (this.gE('stantionText_'+stantion)) {
			area.removeChild(this.gE('stantionText_'+stantion));
		}
	},
	
	getPrintStantionLink : function(stantion){
		return this.gE('link_'+stantion);
	},
	
	getPrintStantionSelector : function(stantion){
		return this.gE('pointer_'+stantion);
	},
	
	printStantionSelect : function(stantion){
		var selector;
		selector = this.getPrintStantionSelector(stantion);
		if (selector && selector.style.display!='block') {
			selector.style.display='block';
		}
		this.addStantionText(stantion);
	},
	
	printStantionUnSelect : function(stantion){
		var selector;
		selector = this.getPrintStantionSelector(stantion);
		if (selector && selector.style.display=='block') {
			selector.style.display='none';
		}
		this.removeStantionText(stantion);
	},

	getPrintLineLink : function(line){
		return this.gE('slink_'+line);
	},
	
	printLineSelect : function(line){
		var link;
		link = this.getPrintLineLink(line);
		if (link && link.style.fontWeight!='bold') {
			link.style.fontWeight='bold';
		}
	},
	
	printLineUnSelect : function(line){
		var link;
		link = this.getPrintLineLink(line);
		if (link && (link.style.fontWeight=='bold' || link.style.fontWeight=='700')) {
			link.style.fontWeight='normal';
		}
	},
	
	getPrintDistrictLink : function(district){
		return this.gE('link_'+district);
	},
	
	printDistrictSelect : function(district){
		var link;
		link = this.getPrintDistrictLink(district);
		if (link && link.className!='check') {
			link.className='check';
		}
		this.addDistrictText(district);
	},
	
	printDistrictUnSelect : function(district){
		var link;
		link = this.getPrintDistrictLink(district);
		if (link && link.className=='check') {
			link.className='';
		}
		this.removeDistrictText(district);
	},
	
	addDistrictText : function(district) {
		var area;
		area = this.gE('districts_text');
		if (!this.gE('districtText_'+district)) {
            var tmp = area.innerHTML.split(", ");
            tmp[tmp.length]='<a href="#" onclick="metroMap.districtUnSelect(\''+district+'\'); return false;" id="districtText_'+district+'">'+this.getPrintDistrictLink(district).innerHTML+'</a>';
            var tmp1 = [];
            for(var i=0;i<tmp.length;i++){
                if(tmp[i]!="" && tmp[i]!=" "){
                    tmp1[tmp1.length]=tmp[i];
                }
            }
            tmp = tmp1;
			//area.innerHTML+='<span id="districtText_'+district+'">, <a href="#" onclick="metroMap.districtUnSelect(\''+district+'\'); return false;">'+this.getPrintDistrictLink(district).innerHTML+'</a></span>';
            area.innerHTML = tmp.join(", ");
		}
	},
	
	removeDistrictText : function(district) {
		var area;
		area = this.gE('districts_text');
		if (this.gE('districtText_'+district)) {
			area.removeChild(this.gE('districtText_'+district));
            var tmp = area.innerHTML.split(", ");
            var tmp1 = [];
            for(var i=0;i<tmp.length;i++){
                if(tmp[i]!="" && tmp[i]!=" "){
                    tmp1[tmp1.length]=tmp[i];
                }
            }
            area.innerHTML = tmp1.join(", ");
		}
	},
	
	switchToList : function(){
		this.save();
		popupElHide('idPopupMap');
		printFilterRegions();
	},
	
	switchToMap : function(){
		popupElHide('block_filter_region');
		this.loadAndOpen();
	}
}

function chSt(el){
	metroMap.stantionSwitch(el.id.replace('link_','').replace('pointer_',''));
}

function chL(el){
	metroMap.lineSwitch(el.id.replace('slink_','').replace('link_',''));
}

function chP(el){
	metroMap.partStantionsSwitch(el.id.replace('link_',''));
}  

function chO(el){
	metroMap.districtSwitch(el.id.replace('link_',''));
}

function chR(el){
	var id = el.id.replace('link_','');
	if (id!=202 && $('mapMenu_'+id) && $('mapMenu_'+id).className!='act' && !metroMap.isRegionSelected(id)) {
		$('mapMenu_'+id).className='act';
	}
	metroMap.regionSwitch(id);
}

function chPM(el) {
	var parent = el.parentNode;
	if (parent.className =='act') {
		parent.className="";
	} 
	else {
		parent.className="act";
	}	
}

/*End Moscow metro map */


/* Moscow region map */
function WardHide(id1,id2){
	if ($(id1) || $(id2)) {
		$(id1).style.display="none";
		$(id2).style.display="none";
	}
	
}

function WardShow(id1,id2){
	if ($(id1) || $(id2)) {
			$(id1).style.display="block";
			$(id2).style.display="block";
		}
}

function checkCity( element ) {
	var indexId, id;
	id = element.id.replace('city_','');
	if( element.checked ) {
		selectedFilterRegions.push(id);
		Ext.DomHelper.append('checkCityId', {tag: 'li', id: 'selected_' + id, children: {tag: 'a', href: '#', onclick: 'delCity("selected_' + id + '", "' + id + '"); return false;', html: element.value}} );
	} else {
		indexId = arraySearch(id,selectedFilterRegions);
		selectedFilterRegions.splice(indexId,1);
		$( 'checkCityId' ).removeChild( Ext.DomQuery.selectNode( '#selected_' + id ) );
	}
}
function checkHighway( element ) {
	var indexId, id;
	id = element.id.replace('highway_','');
	if( element.checked ) {
		selectedFilterRegions.push(id);
		Ext.DomHelper.append('checkHighwayId', {tag: 'li', id:'selected_' + id, children: {tag: 'a', href: '#', onclick: 'delHighway("selected_' + id + '", "' + id + '"); return false;',  html: element.value}} );
		if ($('alt_' + element.id)) {
			$('alt_' + element.id).style.display="block";
			$('alt_' + element.id).style.visibility="visible";
		}
	} else {
		indexId = arraySearch(id,selectedFilterRegions);
		selectedFilterRegions.splice(indexId,1);
		$('checkHighwayId').removeChild( Ext.DomQuery.selectNode('#selected_'+id));
		if ($('alt_' + element.id)){
			$('alt_' + element.id).style.display="none";
			$('alt_' + element.id).style.visibility="hidden";
		}
	}
}
function cleanCity(noClearArray){
	//checkHighwayId
	var highway = Ext.DomQuery.select( '#checkHighwayId/li' );
	for( i in highway ) {
		if( typeof highway[ i ] != "function" ) $( 'checkHighwayId' ).removeChild( highway[ i ] );
	}
	
	var city = Ext.DomQuery.select( '#checkCityId/li' );
	for( i in city ) {
		if( typeof city[ i ] != "function" ) $('checkCityId' ).removeChild( city[ i ] );
	}
	
	var checkboxes = Ext.DomQuery.select( "div.wrapPopub input[@type='checkbox']" );
	for( i in checkboxes ) {
		if( typeof checkboxes[ i ] != "function" ) {
			checkboxes[ i ].checked = false;
		}
	}
	var altPopub = Ext.DomQuery.select('div.wrapHighway div.nameHighway');
	for( i in altPopub ) {
		if( typeof altPopub[ i ] != "function") {
			altPopub[i].style.visibility="hidden";
			altPopub[i].style.display="none";
		}
	}
	if (!noClearArray) {
		selectedFilterRegions = new Array();
	}
	

}

function delCity(element, checkId){
	indexId = arraySearch(checkId,selectedFilterRegions);
	selectedFilterRegions.splice(indexId,1);
	checkId = 'city_'+checkId;
	$('checkCityId').removeChild($(element));
	$(checkId).checked = false;
}
function delHighway(element, checkId){
	indexId = arraySearch(checkId,selectedFilterRegions);
	selectedFilterRegions.splice(indexId,1);
	checkId = 'highway_'+checkId;
	$( 'checkHighwayId' ).removeChild($(element));
	$(  checkId ).checked = false;
	if ($('alt_' + checkId)) {
		$('alt_' + checkId).style.display="none";
		$('alt_' + checkId).style.visibility="hidden";
	}
}

function checkMoscowMapItem(id){
	if ($('city_'+id)) {
		$('city_'+id).checked=true;
		if (!$('selected_'+id)) {
			Ext.DomHelper.append('checkCityId', {tag: 'li', id: 'selected_' + id, children: {tag: 'a', href: '#', onclick: 'delCity("selected_' + id + '", "' + id + '"); return false;', html: regionFilterArrayRegionsIds[id]['title']}} );
		}
	} else if ($('highway_'+id)) {
		$('highway_'+id).checked=true;
		if (!$('selected_'+id)) {
			Ext.DomHelper.append('checkHighwayId', {tag: 'li', id:'selected_' + id, children: {tag: 'a', href: '#', onclick: 'delHighway("selected_' + id + '", "' + id + '"); return false;',  html: regionFilterArrayRegionsIds[id]['title']}} );
		}
		if ($('alt_highway_'+id)) {
			$('alt_highway_'+id).style.display="block";
			$('alt_highway_' + id).style.visibility="visible";
		}
	}
}

function moscowMapShow(){
	cleanCity(true);
	var i;
	for (i=0; i<selectedFilterRegions.length; i++) {
		checkMoscowMapItem(selectedFilterRegions[i]);
	}
	popupElShow('idPopupRussiaMap');
}

function moscowMapSwitchToList(){
	popupElHide('idPopupRussiaMap');
	printFilterRegions();
}

function moscowMapSwitchToMap(){
	popupElHide('block_filter_region');
	moscowMapShow();
}
/*End Moscow region map */



$(function(){

  // IE6 Background Fix
  if ($.browser.msie) try {document.execCommand("BackgroundImageCache", false, true)} catch(e) { };
  
  // Search ID
  $(".searchId").click(function(){
    $("#searchIdForm").submit();
    return false;
  });
    $("#searchIdForm").bind("submit",function(){
        return searchIdEvent();
    });
  
  // 
  
  $(".selsve").click(function(){
    $(this).parent().fadeOut();
  });
  
  $(".bp").click(function(){
    var cur=($(this).index())+1;
    var all=$(".bp").size();
    
    if(cur+1>all){
      cur=1;
    }else{
      cur++;
    }
    
    $(".bp").hide();
    //$(".bp"+cur).show();
    $(".bp"+cur).css("display","inline");
    $(".photo_ul li").removeClass('active');
    $(".photo_ul li a").each(function(){
        if($(this).attr("rel")!=cur){
            $(this).children("img").animate({"opacity":"0.4"}, 200);
        }
        else{
            $(this).children("img").animate({"opacity":"1"}, 200);
        }
    });
    $(".photo_ul li a[rel="+cur+"]").parent().addClass('active');
    
    return false;
  });
  
  // Form Hints
  $("input[val]").each(function(){
    var val=$(this).val();
    if(val==""||val==$(this).attr('val')) $(this).addClass('hinting').val($(this).attr('val'));
    $(this).focus(function(){
      if($(this).attr('val')==$(this).val()){
        $(this).removeClass('hinting').val('');
      }  
    });
    $(this).blur(function(){
      if($(this).val()==""){
        $(this).addClass('hinting').val($(this).attr('val'));
      }  
    });
  });
  
  $("input.number").keyup(function(){
    if($(this).val().replace(/e/g, 'q')>=0){
      $(this).css({color:"black"});
    }else{
      $(this).css({color:"red"});
    }
  });	
  
  // Main Search
  $("#mainSearchButton").live('click',function(){
    metroMap.save();
    $("form[name=mainSearch]").submit();
  });
  
  
  // Open Search Form
  $('.formNav .but1').click(function() {
    $(".param_popup").slideDown(800);
    $(this).fadeOut();
    
    setCookie('searchForm','open',50);
    
    return false;
  })
  
  // Hide Search Form
  $('.param_popup .param_svern').click(function() {
    $(".param_popup").slideUp(800);
    $('.formNav .but1').fadeIn();
    
    setCookie('searchForm','close',50);
    
    return false;
  });
  
  // Select Open
  /*$('.Selecter').click(function() {
    var rel=$(this).attr('rel');
    $(".Select[rel="+rel+"]").fadeIn();
    
    return false;
  });
  
  // Select Close
  $('.Select a').click(function() {
    var n =  $(this).html();

    var rel = $(this).parent().parent().parent().attr('rel');
    var val = $(this).attr('val');

    if($('.Selecter[rel='+rel+']').html().indexOf("inSelecter")>0){
        n="<span class='inSelecter'>"+n+"</span>";
    }
    $("input[name="+rel+"]").val(val);
    
    $('.Selecter[rel='+rel+']').html(n);
    $(".Select[rel="+rel+"] li").removeClass("acti");
    $(this).parent("li").addClass("acti");
    $(this).parent("li").prependTo(".Select[rel="+rel+"] ul");
    $(".Select[rel="+rel+"]").fadeOut();
    
    */
    //valuteChange();
    //valueChange();
    
    
    /*return false;
  });*/
  
  // Adapt:Rtvs
  /*$('#map_id option[value="1"]').click(function(){
    $(".contenerMap").toggle();
    //$(".contenerGoogleMap").hide();
    $(".contenerGoogleMap").css({"position":"absolute"});
    //$(this).toggleClass('but2');
    //if($(this).parent().attr('class')=="buttons") document.location="#";
    
    return false;
  });*/
  
  // Adapt:Rtvs

  $('#map_id').bind('change',function(){
    var val = $('#map_id').val();  
    if ( val==="2" ) {  
        if ( $(".contenerGoogleMap").css("position")=="absolute"  ) {
             $(".contenerGoogleMap").css({"position":"relative"});
             $(".contenerGoogleMap").css({"top":0});
        } else {
            $(".contenerGoogleMap").css({"position":"absolute"});
            $(".contenerGoogleMap").css({"top":-948});
        }    

        $(".contenerMap").hide();
        //$('.contenerRealtyNews').addClass('hidden');
        //$(this).toggleClass('but2');
        //if($(this).parent().attr('class')=="buttons") document.location="#";

        return false;
    }else if ( val==="1") {
        $(".contenerMap").toggle();
        //$(".contenerGoogleMap").hide();
        $(".contenerGoogleMap").css({"position":"absolute"});
        $(".contenerGoogleMap").css({"top":-948});
        //$('.contenerRealtyNews').addClass('hidden');
        //$(this).toggleClass('but2');
        //if($(this).parent().attr('class')=="buttons") document.location="#";

        return false;
    }else{
        $(".contenerGoogleMap").css({"position":"absolute"});
        $(".contenerGoogleMap").css({"top":-948});
        $(".contenerMap").hide();
        //$('.contenerRealtyNews').removeClass('hidden');
        return false;
    }
  });

  $('.checks input[name="map_id[]"]').live('change',function(){
    var val = $(this).val();  
    if ( val==="1" ) {  
        if ( this.checked ) {                        
            //$(".contenerGoogleMap").hide();
            $(".contenerGoogleMap").css({"position":"absolute"});    
            $(".contenerGoogleMap").css({"top":-2000});            
            $(".contenerMap").show();
            $("#map_id_1").removeAttr("checked");
            $('.contenerRealtyNews').addClass('hidden');
        } else {
            $(".contenerMap").hide();
                        
            //$(".contenerGoogleMap").show();
            $('.contenerRealtyNews').removeClass('hidden');
            /*$(".contenerGoogleMap").css({"position":"static"});    
            $(".contenerGoogleMap").css({"top":0});
            $("#map_id_1").attr("checked","checked");*/
            
        }            
        //$(this).toggleClass('but2');
        //if($(this).parent().attr('class')=="buttons") document.location="#";
        return false;
    }else if ( val==="2") {
        if ( this.checked ) {
            
             $(".contenerMap").hide(); 
             $('.contenerRealtyNews').addClass('hidden');
             
             $(".contenerGoogleMap").css({"top":0});
             $(".contenerGoogleMap").css({"position":"static"});    
             //$(".contenerGoogleMap").show();
             $("#map_id_0").removeAttr("checked");
             $('.contenerRealtyNews').addClass('hidden');
        }else{
             //$(".contenerGoogleMap").hide();
             $(".contenerGoogleMap").css({"position":"absolute"});    
             $(".contenerGoogleMap").css({"top":-2000}); 
             
             $('.contenerRealtyNews').removeClass('hidden');
             /*$(".contenerMap").show();
               $("#map_id_0").attr("checked","checked");*/
        }             
        //$(this).toggleClass('but2');
        //if($(this).parent().attr('class')=="buttons") document.location="#";        
        return false;
    }
  });
 
  /*$("#map_id option[value='']").click(function(){
      $(".contenerGoogleMap").css({"position":"absolute"});
      $(".contenerMap").hide();
      return false;
  });*/
  
  // Valute Change
  /*function valuteChange(){
    var actmincost=$("input[name=costmin]").val();
	  var actmaxcost=$("input[name=costmax]").val();
	  actmincost=actmincost.replace(/e/g, 'q');
	  actmaxcost=actmaxcost.replace(/e/g, 'q');
	  
	  var valut=$("input[name=valute]").val();
	  var value=$("input[name=value]").val();
	   
	  var maxcost=costmax[value];
	  
	  if(actvalute==1){
	    maxcost=Math.round(costmax[value]/valute[valut]);
	    actmincost=Math.round($("input[name=costmin]").val()/valute[valut]);
	    actmaxcost=Math.round($("input[name=costmax]").val()/valute[valut]);
	  }else{
	    maxcost=Math.round(costmax[value]/valute[valut]);
	    actmincost=Math.round($("input[name=costmin]").val()*valute[actvalute]/valute[valut]);
	    actmaxcost=Math.round($("input[name=costmax]").val()*valute[actvalute]/valute[valut]);
	  }
	  
	  if(actmaxcost>=maxcost-Math.ceil(valute[actvalute]/valute[valut]/2)&&actmaxcost<=maxcost){
	    actmaxcost=maxcost;
	  };
	  
	  actvalute=valut;
	  actvalute2=valut;
	  
	  $("input[name=costmin]").val(actmincost);
	  $("input[name=costmax]").val(actmaxcost);
  }*/
  
  // Value Change
  /*function valueChange(){
	  var actmincost=$("input[name=costmin]").val();
	  var actmaxcost=$("input[name=costmax]").val();
	  actmincost=actmincost.replace(/e/g, 'q');
	  actmaxcost=actmaxcost.replace(/e/g, 'q');
	  
	  var valut=$("input[name=valute]").val();
	  var value=$("input[name=value]").val();
	  
	  var maxcost=costmax[value]/valute[valut];
	  
	  var minsq2=$("input[name=sqmin]").val();
	  var maxsq2=$("input[name=sqmax]").val();
	  
	  
	  if(actvalue==2){
	    actmincost=actmincost*12/minsq2;
	    actmaxcost=actmaxcost*12/maxsq2;
	  }
	  if(actvalue==3){
	    actmincost=actmincost/minsq2;
	    actmaxcost=actmaxcost/maxsq2;
	  }

	  if(value==1){
	    actmincost=Math.round(actmincost);
	    actmaxcost=Math.round(actmaxcost);
	  }
	  if(value==2){
	    actmincost=Math.round(actmincost*minsq2/12);
	    actmaxcost=Math.round(actmaxcost*maxsq2/12);
	    var tt=actmaxcost/12;
	  }
	  if(value==3){
	    actmincost=Math.round(actmincost*minsq2);
		actmaxcost=Math.round(actmaxcost*maxsq2);
	    var tt=actmaxcost/144;
	  }
	  
	  actmincost=Math.round(actmincost);
	  actmaxcost=Math.round(actmaxcost);
	  
	  if(actmaxcost>=maxcost-Math.ceil(maxsq2*12)&&actmaxcost<=maxcost){
	    actmaxcost=Math.round(maxcost);
	  };
	  
	  if(actmincost>actmaxcost) actmincost=actmaxcost-tt;
	  
	  actvalue=value;
	  actvalue2=value;
	  
	  $("input[name=costmin]").val(actmincost);
	  $("input[name=costmax]").val(actmaxcost);
  }*/
  
  // Footer Fix
  /*var body_height = $(window).height();
  var content_height = $(".container").height();
  if (content_height < body_height ) {
    $(".container").css("minHeight", body_height+"px");
  }
  var cont_height = $(".container").height();
  $(".favor_podl").height(cont_height);
  
  // Footer Fix Resize
  $(window).resize(function(){
    var body_height = $(window).height();
    var content_height = $(".container").height();

    $(".container").css("minHeight", body_height+"px");
  })
  
  $(".print").mousedown(function(){
    var href=$(this).attr('href');
    var href=href+"?print";
    if($("#ADesc2").css("display")!="none"){href=href+"&adddesc=1";}
    var str=$(".stroenie");
    for(var t=1;t<=str.length;t++){
      if($("#B"+t+"Desc2").css("display")!="none"){href=href+"&strdesc"+t+"=1";}
    }
    var off=$(".off_desc");
    for(var t=0;t<off.length;t++){
      var p=$(off[t]).attr("id");
      if($(".osn_info"+p).css("display")!="none"){href=href+"&offdesc"+p+"=1";}
    }
    $(".print").attr({href:href});
  });

  $('.photo_ul a').click(function() {
    var arel=$(this).attr("rel");
    $(".bp").hide();
    //$(".bp"+arel).show();
    $(".bp"+arel).css("display","inline");
    $(".photo_ul li").removeClass('active');
    $(".photo_ul li a").each(function(){
        if($(this).attr("rel")!=arel){
            $(this).children("img").animate({"opacity":"0.4"}, 200);
        }
        else{
            $(this).children("img").animate({"opacity":"1"}, 200);
        }
    });
    $(this).parent().addClass('active');
    
    return false;
  });
  
  $(".hed").hover(function(){
    $(this).addClass('hed_hover');
  },function(){
    $(this).removeClass('hed_hover');
  });
  
  $(".pdfthis").click(function(){
    $("#pdfthis").submit();
    return false;
  });
  $(".selectimg").bind("change",function(){
      if($(this).attr("checked")){
          try{$("#pdfthis").append("<input type='hidden' name='showimg["+$(this).attr("name")+"]' value='1' />");}catch(e){}
      }
      else{
          try{$("#pdfthis").append("<input type='hidden' name='showimg["+$(this).attr("name")+"]' value='0' />");}catch(e){}
      }
  });
  $(".printthis").click(function(){
      try{
          $("#pdfthis").append("<input type='hidden' name='nopdf' value='1' />");
          $("#pdfthis").submit();
      }catch(e){}
      return false;
  });
  $('.hed').click(function() {
    var ntr=$(this).next("tr");
    var id=$(this).attr('rel');
    
    if ($(ntr).is(":visible")) {
        try{$("#pdfthis").append("<input type='hidden' name='offdesc"+id+"' value='0' />");}catch(e){}
      $(ntr).hide();
      $(this).removeClass("hed_active");
    }else{
        try{$("#pdfthis").append("<input type='hidden' name='offdesc"+id+"' value='1' />");}catch(e){}
      $(".osn_info"+id).load("/ajax/office.php?id="+id,function(){
        $(ntr).show();
        
        $('.table_vl_close2').click(function() {
          $(this).parent("div").parent("td").parent("tr").hide();
          $(this).parent("div").parent("td").parent("tr").prev("tr").removeClass("hed_active");
          
          return false;
        });
      });
      
      $(this).addClass("hed_active");
    }
    return false;
  });
    
  $(".str_opis").each(function(){
    var height=$(".str_opis2",this).children(".table1").height()+10;
    if(height<100){
      $(".but1,.str_opis_fader",this).hide();
      $(".str_opis2",this).css({'height':'auto'});
    }
  });

  $('.str_full_details').click(function() {
    var theight=$(this).prev(".str_opis2").children(".table1").height()+10;
    $(this).prev(".str_opis2").animate({height: theight+'px'});
    $(this).prev(".str_opis2").children(".str_opis_fader").removeClass("str_opis_fader_bg");
    $(this).hide();
    $(this).next(".str_short_details").show();
    
    return false;
  });
  
  $('.str_short_details').click(function() {
    $(this).prev().prev(".str_opis2").animate({height: '90px'});
    $(this).prev().prev(".str_opis2").children(".str_opis_fader").addClass("str_opis_fader_bg");
    $(this).hide();
    $(this).prev(".str_full_details").show();
    
    return false;
  });
  
  $(".vhod a").click(function(){$(".favor_podl, .auth_block").fadeIn();} );
  
  $(".favor_podl").click(function(){$(".favor_podl, .auth_block").fadeOut();} );
});
$(document).ready(function(){
  $("ul.photo_ul li a").hover(
    function(){
        $(this).children("img").animate({"opacity":"1"}, 200);
    },
    function(){
        if(!$(this).parent().hasClass("active"))
        $(this).children("img").animate({"opacity":"0.4"}, 200);
    }
  );
  $(".home_table tbody tr td a").hover(
    function(){
        $(this).children(".imgborder").show();
    },
    function(){
        $(this).children(".imgborder").hide();
    }
  );*/
});

$(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': false});
    }); 

$(document).ready(function() {
       $(".fancySladeShow").attr("rel","realestateFotos"); 
       $(".fancySladeShow[rel=realestateFotos]").fancybox({
                        'showCloseButton': true,
                        'overlayShow' : true,
                	'transitionIn': 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                                                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                                                  }                                   
       });                        
    }); 
    
$(document).ready(function() {
          $(".fancyFrame").fancybox(
                        {'width': 800, 'height':600, 'frameWidth' : 800, 'frameHeight': 600, 'overlayShow': true, 'hideOnContentClick': false});
    }); 
