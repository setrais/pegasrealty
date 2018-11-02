CKEditor Plugin Stat
=============
The plugin displays a status bar information about a text editor: total number of characters, number of selected characters, the number of characters in the Source
Install
------------
Create folder `ckeditor/plugins/stat` and unpack archive to 

File `ckeditor/config.js`

	CKEDITOR.editorConfig = function( config ){
		config.extraPlugins = 'stat,onselect,onchange'; // add plugin
		config.stat = {selected:true,all:true,html:true}; // what statistics output
	};
	
Required
------------
Plugin [onselect][onselect] and [onchange][onchange]

Version 1.5 for ckeditor 4.* works without onselect and onchange

1. [Demo][demo]
2. [Author][author]
3. [more ckeditor Plugins][more]
[demo]: http://xdan.ru/project/ckplugins/#demo_stat
[author]: http://xdan.ru/user/profile/Leroy
[more]: http://xdan.ru/project/ckplugins/
[onselect]: https://github.com/xdan/ck_onselect
[onchange]: https://github.com/xdan/ck_onchange
