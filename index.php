<?
$files = scandir(__DIR__);

foreach ($files as $file) {
	if (strpos($file, '.html') !== false) {
		$html = file_get_contents($file);
		if (isset($_GET['edit'])) {
			$html = str_replace('</body>', getReSpellAdditions().'</body>', $html);
		} else {
			$html = str_replace('</body>', getDefaultAdditions().'</body>', $html);
		}
		echo $html;
		break;
	}
}


function saveData($data) {
	$files = scandir(__DIR__);
	foreach ($files as $file) {
		if (strpos($file, '.hyperesources') !== false) {
			file_put_contents($file . '/data.json', $data);
			break;
		}
	}
}

// if (isset($_POST['data'])) {
// 	saveData($_POST['data']);
// }


function getDefaultAdditions(){
ob_start(); ?>

	<script>
	/* 
		A magic spell that allows you to edit the page. 
	*/
	let magicSpell = [77, 65, 71, 73, 67];
	let magicIndex = 0;
	
	document.addEventListener("keydown", function(e) {
	  if (e.keyCode === magicSpell[magicIndex]) {
		magicIndex++;
		if (magicIndex === magicSpell.length) {
		  let url = new URL(window.location.href);
		  url.searchParams.set("edit", "");
		  window.location.href = url.href.replace('edit=', 'edit');
		}
	  } else {
		magicIndex = 0;
	  }
	});
	</script>
	
<?php
return ob_get_clean();
}


function getReSpellAdditions() {
ob_start(); ?>

	<style>
		.re-spell-treeview ul {
			padding-inline-start: 20px;
		}
	
		.re-spell-treeview li {
			list-style-type: none;
			margin-left:10px;
		}
		.re-spell-treeview li div::before {
			content: "";
			width: 17px;
			height: 17px;
			position: absolute;
			top: 8px;
			left: 10px;
			background-image: url(data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgNDggNDgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMzMzIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIHN0cm9rZS13aWR0aD0iMiI+PHBhdGggZD0ibTUgMzBoMzh2LTE5Ii8+PHBhdGggZD0ibTEyIDIzLTcgNyA3IDciLz48L2c+PC9zdmc+);
		}

		.re-spell-treeview li div {
			align-items: center;
			background-color: #f8f9fc;
			border: 1px solid #d1d1d1;
			box-sizing: border-box;
			color: #3D4349;
			display: flex;
			padding: 7px 10px 7px 35px;
			position: relative;
			margin-top: -1px;
			font-family: sans-serif;
			line-height: 16px;
		}
		
		.re-spell-treeview {
			position: fixed; 
			z-index: 500;
			top: 0px;
			height:100vh;
			overflow: scroll;
			transition: right 0.5s;
			background: linear-gradient(90deg, rgba(0,0,0,0) 0%,rgba(0,0,0,1) 50%);
		}
		
		.re-spell-treeview small{
			opacity: 0.4;
			font-size: 9px;
			padding-top: 5px;
			padding-right: 3px;
		}
		
		.re-spell-treeview:not(.open){
			right: -100%;
		}
		
		.re-spell-treeview.open {
			right: 0px;
		}
		
		.re-spell-edit {
			position: fixed;
			z-index: 500;
			bottom: calc(50% + 75px);
			transform: rotate(-90deg);
			transform-origin: 100% 100%;
			right: 0px;
			padding: 10px;
			border-radius: 10px 10px 0px 0px;
			border: 1px;
			width: 150px;
			height: 35px;
		}
		
		.re-spell-modal {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			padding: 30px;
			border-radius: 5px;
			background-color: #f8f9fc;
			border: 1px solid #d1d1d1;
			z-index: 2000;
		}
		
		.re-spell-modal textarea{
			width: 600px;
			height: 200px;
			padding-bottom: 20px;
		}
		
		.re-spell-modal button{
			margin-top: 6px;
			margin-right: 9px;
		}
		
		.re-spell-overlay {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.65);
			z-index: 1000;
		}
		
		[data-magic-key]::before {
			position: absolute;
			 content: "Data Magic";
			 z-index: 10;
			 top: -16px;
			 left: 0px;
			 height: 15px;
			 display: flex;
			 align-items: center;
			 justify-content: center;
			 font: 8px Arial;
			 color: white;
			 background: #75A4EA;
			 border-radius: 0.2rem 0.2rem 0 0;
			 padding: 0.5rem;
			 box-sizing: border-box;
			 transition: all 0.25s;
		}
		
		[data-magic-key]:after {
			content: " ";
			position: absolute;
			z-index: -1;
			top: 0px;
			left: 0px;
			right: 0px;
			bottom: 0px;
			border: 1px solid #75A4EA;
			opacity:0.5;
			transition: all 0.25s;
		}
		
		.active > div{
			color: #fff !important;
			background-color: #75A4EA !important;
		}
		/*
		[data-magic-key]:hover::after, .HYPE_element:hover [data-magic-key]::after {
			opacity:0.15;
		}
		
		[data-magic-key]:hover::before, .HYPE_element:hover [data-magic-key]::before {
			opacity:0;
			transform: translate(4px);
			overflow:hidden;
			clip: rect(0px, 0px, 0px, 0px);
		}
		*/
		
		
	</style>
	<button class="re-spell-edit">Inhalte bearbeiten …</button>
	<div class="re-spell-treeview"></div>
	<script>
	
	/**
	 * Converts a key and value to a string.
	 *
	 * @param {strin} key
	 * @param {string|number|boolean|object|function} value
	 * @param {string} indent
	 * @return {string}
	 */
	function keyToString(key, value, indent) {
		switch (typeof value) {
			case "object":
				if (Array.isArray(value)) {
					return stringifyArray(value, indent+'\t');
				} else {
					return  stringifyObject(value, indent+'\t');
				}
				break;
			case "function":
				return value.toString();
				break;
			case "string":
				return  "\"" + value + "\"";
				break;
			case "number":
				return value;
				break;
			case "boolean":
				return value;
				break;
			default:
				return value;
		}
	}
	
	/**
	 * Converts an array to a string.
	 *
	 * @param {array} arr
	 * @param {string} indent
	 * @return {string}
	 */
	function stringifyArray(arr, indent) {
		let str = "[";
		for (let i = 0; i < arr.length; i++) {
			str += keyToString(i, arr[i], indent);
			str += ",";
		}
		str += "]";
		return str;
	}
	
	/**
	 * Converts an object to a string.
	 *
	 * @param {object} obj
	 * @param {string} indent
	 * @return {string}
	 */
	function stringifyObject(obj, indent) {
		let str = "{";
		if (Object.keys(obj).length){
			for (let key in obj) {
				str += "\n" + indent + "\t" + key + ": " + keyToString(key, obj[key], indent);
				str += ",";
			}
			str += "\n" + indent + "}";
		} else {
			str += "}";
		}
		return str;
	}
	
	/**
	 * Converts an object or array to a string.
	 *
	 * @param {object} obj
	   * @param {number} indent
	   * @return {string}
	   */
	function stringify(obj, indent) {
		if (Array.isArray(obj)) {
			return stringifyArray(obj, indent);
		} else {
			return stringifyObject(obj, indent);
		}
	}
	
	/**
	 * This function builds a tree of the data. It is used by the HypeDataMagic.
	 * 
	 * @param {object} data - The data object
	 * @param {HTMLElement} parent - The parent element
	 * @param {string} path - The path to the data
	 */
	function buildTree(data, parent, path) {
		path = path? path+'.' : '';
		const ul = document.createElement('ul');
		for (let key in data) {
			const li = document.createElement('li');
			const div = document.createElement('div');
			div.innerHTML = '<small>'+path+'</small>'+key;
			li.appendChild(div);
			if (typeof data[key] === 'object') {
				buildTree(data[key], li, path+key);
			} else {
				div.addEventListener('click', function(event) {
					
					scrollToActiveElement(event.target.closest('li'));
					
					const modal = document.createElement('div');
					modal.classList.add('re-spell-modal');
			
					const overlay = document.createElement('div');
					overlay.classList.add('re-spell-overlay');
					overlay.addEventListener('click', function() {
						modal.parentNode.removeChild(modal);
						overlay.parentNode.removeChild(overlay);
					});
					
					const input = document.createElement('textarea');
					input.value = data[key];
					
					const save = document.createElement('button');
					save.innerHTML = 'save';
					save.addEventListener('click', function() {
						data[key] = input.value;
						HypeDataMagic.refresh();
						overlay.parentNode.removeChild(overlay);
						modal.parentNode.removeChild(modal);
					});
					
					const abort = document.createElement('button');
					abort.innerHTML = 'abort';
					abort.addEventListener('click', function() {
						modal.parentNode.removeChild(modal);
						overlay.parentNode.removeChild(overlay);
					});
					
					modal.appendChild(input);
					modal.appendChild(save);
					modal.appendChild(abort);
					
					document.body.appendChild(overlay);
					document.body.appendChild(modal);
				});
			}
			ul.appendChild(li);
		}
		parent.appendChild(ul);
	}
	
	/*
		Open the sidebar when the edit button is clicked.
	*/
	const sidebar = document.querySelector('.re-spell-treeview');
	const button = document.querySelector('button.re-spell-edit');
	
	button.addEventListener('click', function() {
		sidebar.classList.toggle('open');
	});
	
	/*
		Close the sidebar when the user clicks outside of the sidebar.
	*/
	document.body.addEventListener('click', function(event) {
		if (event.target.closest('.re-spell-treeview li, .re-spell-edit, .re-spell-overlay, .re-spell-modal')) return;
		sidebar.classList.remove('open');
	});
	
	/* 
		Check if the URL has the parameter "edit" and if it does, add the class "re-spell" to the body.
	*/
	let urlParams = new URLSearchParams(window.location.search);
	if(urlParams.has('edit')) {
		document.body.classList.add("re-spell");
	}
	
	
	document.addEventListener('keydown', function(e) {
		var e = e || window.event;
		var keyCode = e.keyCode || e.which;
		if(!e.shiftKey) return;

		if (!document.querySelector('.re-spell-treeview').classList.contains('open')){
			if (keyCode == 32) document.querySelector('.re-spell-treeview').classList.toggle('open');
			return;
		}
		
		if(keyCode == 38){
		
			if(active.previousElementSibling){
				active.className = '';
				active = active.previousElementSibling;
				active.className = 'active';
				scrollToActiveElement(active);
			}else if(active.parentNode.parentNode.tagName == 'LI'){
				active.className = '';
				active = active.parentNode.parentNode;
				active.className = 'active';
				scrollToActiveElement(active);
			}else if(active.getElementsByTagName('ul').length){
				active.className = '';
				var i = active.getElementsByTagName('ul')[0].getElementsByTagName('li').length-1;
				active = active.getElementsByTagName('ul')[0].getElementsByTagName('li')[i];
				active.className = 'active';
				scrollToActiveElement(active);
			}
		} else if (keyCode == 40){
			if(active.getElementsByTagName('ul')[0]){
				active.className = '';
				active = active.getElementsByTagName('ul')[0].getElementsByTagName('li')[0];
				active.className = 'active';
				scrollToActiveElement(active);
			} else if(active.nextElementSibling){
				active.className = '';
				active = active.nextElementSibling;
				active.className = 'active';
				scrollToActiveElement(active);
			}else if(active.parentNode.parentNode.nextElementSibling.tagName == 'LI'){
				active.className = '';
				active = active.parentNode.parentNode.nextElementSibling;
				active.className = 'active';
				scrollToActiveElement(active);
			}
		} else if (keyCode == 39){
			if(active.getElementsByTagName('ul')[0]){
				active.className = '';
				active = active.getElementsByTagName('ul')[0].getElementsByTagName('li')[0];
				active.className = 'active';
				scrollToActiveElement(active);
			}
		} else if (keyCode == 37){
			if(active.parentNode.parentNode.tagName == 'LI'){
				active.className = '';
				active = active.parentNode.parentNode;
				active.className = 'active';
				scrollToActiveElement(active);
			}
		} else if (keyCode == 32){
			if (!document.querySelector('.re-spell-modal'))
				active.querySelector('div').click();
		}
		e.preventDefault()
	})
	
	
	
	/*
	This code is used to close the modal and treeview when the escape key is pressed
	*/
	let escPressed = false;
	document.addEventListener('keyup', function(e) {
		if (e.keyCode === 27) {
			if (document.querySelector('.re-spell-modal') && document.querySelector('.re-spell-overlay')) {
				document.querySelector('.re-spell-modal').remove();
				document.querySelector('.re-spell-overlay').remove();
			} else if (document.querySelector('.re-spell-treeview').classList.contains('open')) {
				document.querySelector('.re-spell-treeview').classList.remove('open');
			} else {
				let url = new URL(window.location.href);
				if (escPressed && url.searchParams.has('edit')) {
					url.searchParams.delete('edit');
					window.location.href = url.href;
				} else {
					escPressed = true;
					setTimeout(function() {
						escPressed = false;
					}, 200);
				}
			}
		} else {
			escPressed = false;
		}
	});

	
	document.documentElement.appendChild(sidebar);
	buildTree(HypeDataMagic.getData(), sidebar);
	
	var ul = sidebar.getElementsByTagName('ul')[0];
	var li = ul.getElementsByTagName('li');
	var active = li[0];
	active.className = 'active';
	
	function scrollToActiveElement(activeElm){
		document.querySelectorAll('.active').forEach((elm)=>{
			if (elm!=activeElm) elm.classList.remove('active');
		})
		if (!activeElm.classList.contains('active')) activeElm.classList.add('active');
		activeElm.focus();
		sidebar.scrollTo({
			left: 0,
			top: activeElm.offsetTop - window.innerHeight/2,
			behavior: 'smooth',
		});
	}
	</script>
	
<?php
return ob_get_clean();
}