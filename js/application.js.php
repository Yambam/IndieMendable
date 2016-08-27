<?php
	include('../config.php');
	echo '//'.$_GET['lang']."\r\n";
	echo '//'.gettext('Pages')."\r\n";
	header('Content-type: application/javascript');
?>
function fireEvent(element,event) {
    if (document.createEventObject) {
		var evt = document.createEventObject();
		return element.fireEvent('on'+event,evt)
    } else {
		var evt = document.createEvent("HTMLEvents");
		evt.initEvent(event,true,true);
		return !element.dispatchEvent(evt);
    }
}

Math.sign = Math.sign || function(x) {
  x = +x; // convert to a number
  if (x === 0 || isNaN(x)) {
    return x;
  }
  return x > 0 ? 1 : -1;
}

function updateSearchState() {
	if (document.getElementsByClassName('search-field')[0].value.length < 3) {
		document.getElementsByClassName('search-field-submit')[0].disabled = true;
	} else {
		document.getElementsByClassName('search-field-submit')[0].disabled = false;
	}
};

if (typeof(snowStorm)!=='undefined') {
	snowStorm.excludeMobile = false;
	snowStorm.followMouse = false;
	snowStorm.vMaxX = 8;
	snowStorm.vMaxY = 10;
	snowStorm.snowStick = false;
	//snowStorm.animationInterval = 50;
	//snowStorm.usePositionFixed = true;
}

function removeFiles() {
	dataAdded = this.parentElement.getAttribute('data-added');
	console.log(dataAdded);
	var element = document.getElementById('upload-'+dataAdded);
	/*console.log(element);*/
	if (element) {
		if (element.previousSibling&&element.previousSibling.tagName=='input') {
			element.parentElement.removeChild(element);
		} else {
			if (element.style.display=='none') {
				element.parentElement.removeChild(element);
			} else {
				newelement = document.createElement('input');
				newelement.type = 'file';
				newelement.multiple = element.multiple;
				newelement.name = element.name;
				newelement.id = element.id;
				element.removeEventListener('change',handleFiles);
				newelement.addEventListener('change',handleFiles);
				element.parentElement.insertBefore(newelement,element.nextSibling);
				element.parentElement.removeChild(element);
				element = newelement;
			}
			
			/*element.outerHTML = element.outerHTML;
			window.setTimeout((function(element) {
				return function() {
					element.addEventListener('change',handleFiles);
				}
			})(element),1000);*/
		}
		filesPreviews = document.getElementsByClassName('files-preview');
		numFilesPreviews = filesPreviews.length;
		for(i=0;i<numFilesPreviews;i+=1) {
			filePreviews = filesPreviews[i].getElementsByTagName('div');
			numPreviews = filePreviews.length;
			for(j=numPreviews-1;j>=0;j-=1) if (filePreviews[j].getAttribute('data-added')==dataAdded) {
				if (filePreviews[j].previousSibling&&filePreviews[j].previousSibling.className=='seperator') {
					filesPreviews[i].removeChild(filePreviews[j].previousSibling);
					j-=1;
				} else if (filePreviews[j].nextSibling&&filePreviews[j].nextSibling.className=='seperator') {
					filesPreviews[i].removeChild(filePreviews[j].nextSibling);
				}
				filesPreviews[i].removeChild(filePreviews[j]);
			}
		}
	}
}

function handleFiles() {
	files = this.files;
	
	if ((typeof this.nextSibling != 'undefined')&&(this.nextSibling.className=='files-preview'||this.nextSibling.className=='files-preview seperators-visible')) {
		filesPreview = this.nextSibling;
		if (!this.hasAttribute('multiple')) {
			filesPreview.removeChild(filesPreview.firstChild);
		} else {
			if (this.nextSibling.childNodes.length>=1) {
				seperator = document.createElement('div');
				seperator.className = 'seperator';
				this.nextSibling.appendChild(seperator);
			}
			
			element = document.createElement('input');
			element.type = 'file';
			element.multiple = this.multiple;
			element.name = this.name;
			element.id = this.id;
			this.id = '';
			this.removeEventListener('change',handleFiles);
			element.addEventListener('change',handleFiles);
			this.parentElement.insertBefore(element,this.nextSibling);
			
			this.style.display = 'none';
		}
	} else {
		filesPreview = document.createElement('div');
		filesPreview.className = 'files-preview';
		this.parentElement.insertBefore(filesPreview,this.nextSibling);
	}
	
	addedTimestamp = new Date().getTime().toString();
	this.id = 'upload-'+addedTimestamp;
	
	numFiles = files.length;
	for(i=0;i<numFiles;i+=1) {
		console.log(files[i].name);
		
		filePreview = document.createElement('div');
		filePreview.className = 'no-image';
		filePreview.setAttribute('data-added',addedTimestamp);
		
		var size_output = files[i].size + " bytes";
		for (var multiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"], j = 0, approximation = files[i].size / 1024; approximation > 1; approximation /= 1024, j++) {
			size_output = approximation.toFixed(3) + " " + multiples[j] + " (" + files[i].size + " bytes)";
		}
		
		if (/^image\//.test(files[i].type)) {
			img = document.createElement('img');
			var reader = new FileReader();
			reader.onload = (function(img) { return function(e) { img.src = e.target.result; img.parentElement.className = ''; }; })(img);
			reader.readAsDataURL(files[i]);
			filePreview.appendChild(img);
			
			infoDiv = document.createElement('div');
			infoDiv.innerHTML = files[i].name;
			infoDiv.className = 'info';
			filePreview.appendChild(infoDiv);
		} else if (this.hasAttribute('data-allowed-executable')) {
			infoDiv = document.createElement('div');
			infoDiv.innerHTML = '<b>'+files[i].name+'</b><br>'+files[i].type+', '+size_output;
			infoDiv.className = 'info';
			filePreview.appendChild(infoDiv);
		} else {
			infoDiv = document.createElement('div');
			infoDiv.innerHTML = 'Only images are allowed here!';
			infoDiv.className = 'info';
			filePreview.appendChild(infoDiv);
		}
		
		closeButton = document.createElement('div');
		closeButton.className = 'remove fa fa-times';
		closeButton.title = 'Remove '+(numFiles!=1 ? 'these '+numFiles.toString()+' files' : 'this file');
		closeButton.addEventListener('click',removeFiles);
		filePreview.appendChild(closeButton);
		filesPreview.appendChild(filePreview);
	}
	
	if (numFiles>=2) {
		filesPreview.className = 'files-preview seperators-visible';
	}
}

window.setTimeout(function() {
	if (document.readyState !== "complete") {
		items = document.getElementsByClassName('items');
		for(i=0;i<items.length;i+=1) {
			if (!items[i].style.hasOwnProperty('opacity')) {
				items[i].style.overflow = 'hidden';
				items[i].scrollTop = 0;
				items[i].style.opacity = .5;
				item = items[i].getElementsByClassName('item');
				if (item.length>=1) {
					items[i].scrollTop = item[0].offsetTop;
				}
				/*for(j=0;j<item.length;j+=1) {
					item[j].style.overflow = 'hidden';
				}*/
			}
		}
		
		//Previous and next buttons
		if (!/iPad|iPod|iPhone/.test(navigator.userAgent)) {
			/*prev = document.getElementsByClassName('prev');
			next = document.getElementsByClassName('next');*/
			shift = document.getElementsByClassName('shift');
			for(i=0;i<shift.length;i+=1) {
				shift[i].parentElement.style.overflow = 'hidden';
				if (parseInt(shift[i].getAttribute('data-count'))>=1) {
					prev = document.createElement('div');
					prev.className = 'prev disabled';
					shift[i].parentElement.appendChild(prev);
					
					next = document.createElement('div');
					next.className = 'next';
					shift[i].parentElement.appendChild(next);
				}
				
				/*if (parseInt(shift[i].getAttribute('data-count'))<=2) {
					next[i].className = "next disabled";
				}*/
				
				if (parseInt(shift[i].getAttribute('data-count'))==1) {
					shift[i].parentElement.getElementsByTagName('a')[0].style.width = '100%';
				}
			}
		}
	}
},100);



//Pages (go to page)
function gotoPage() {
	items = this.parentElement.previousSibling.previousSibling;
	page = parseInt(this.innerHTML);
	
	perPage = 4;
	if (items.hasAttribute('data-per-page')) {
		perPage = parseInt(items.getAttribute('data-per-page'));
	}
	
	currentPage = 1;
	if (items.hasAttribute('data-current-page')) {
		currentPage = parseInt(items.getAttribute('data-current-page'));
	}
	items.setAttribute('data-current-page',page)
	
	columns = 1;
	if (items.hasAttribute('data-columns')) {
		columns = parseInt(items.getAttribute('data-columns'));
	}
	
	extra = 0;
	if (items.className.indexOf('seperators')>=0) {
		extra = 1;
	}
	if (items.className=="games items"||items.className=="games-alt items") {
		extra = 3;
	}
	if (items.className=="users items") {
		extra = 8;
	}
	
	pageChooser = this.parentElement;
	pageButton = pageChooser.getElementsByClassName('goto-page');
	pageCount = pageChooser.getAttribute('data-pages');
	j = perPage * page - perPage;
	item = items.getElementsByClassName('item');
	
	/*newTop = 0;
	for(i=0;i<j;i+=columns) {
		//newTop += item[i].scrollHeight + extra;
		newTop += item[i].scrollHeight + extra;
	}*/
	newTop = item[j].offsetTop;
	if (items.className.indexOf('seperators')>=0&&newTop>0) {
		newTop += 1;
	}
	if (items.className=="games items"||items.className=="games-alt items") {
		for(i=0;i<(currentPage-1)*perPage;i+=1) {
			item[i].style.transition = '';
			item[i].style.opacity = '0';
		}
		for(i=currentPage*perPage;i<item.length;i+=1) {
			item[i].style.transition = '';
			item[i].style.opacity = '0';
		}
		window.setTimeout(function() {
			for(i=j;i<j+perPage&&i<item.length;i+=1) {
				item[i].style.transition = '.5s ease 0s opacity';
				item[i].style.opacity = '1';
				//console.log(i);
			}
		},250);
		prevTop = items.scrollTop;
		for(var _i=0;_i!=500;_i+=1000/60) {
			if (_i>500) {
				_i=500;
			}
			(function() {
				var j = _i;
				var x1 = prevTop;
				var x2 = newTop;
				window.setTimeout(function() {
					//items.scrollTop = (1-j/500)*x1+j/500*x2;
					items.scrollTop = x1+(x2-x1)*(.5*(1+Math.cos(Math.PI*(1+j/500))));
					//console.log(newTop);
				},_i);
			}())
			if (_i==500) {
				break;
			}
		}
	} else {
		items.scrollTop = newTop;
	}
	
	/*h = 0;
	for(i=j;i<item.length&&i<j+perPage;i+=columns) {
		h += item[i].scrollHeight + extra;
	}
	if (items.className.indexOf('seperators')>=0) {
		h -= 1;
	}*/
	
	if (item.length>=2) {
		element = item[Math.min(j+perPage-1,item.length-1)];
		//h = element.offsetTop + element.offsetHeight - newTop;
		h = element.offsetTop + parseInt(element.getAttribute('data-rowHeight')) - newTop;
		if (typeof window.getComputedStyle!='undefined') {
			h += parseInt(getComputedStyle(item[0]).marginBottom);
		}
	} else {
		h = parseInt(items[i].style.maxHeight);
	}
	
	for(i=0;i<item.length&&i<j+perPage;i+=1) {
		image = item[i].getElementsByClassName('picture-large');
		for(k=0;k<image.length;k+=1) {
			newImage = image[k].style.backgroundImage.replace('/extra-small/','/medium/').replace('/thumb/','/large/');
			if (newImage!=image[k].style.backgroundImage) {
				image[k].style.backgroundImage = newImage;
			}
		}
	}
	
	if (perPage==4) {
		items.style.transition = '.15s ease 0s max-height';
	} else {
		items.style.transition = '.05s ease 0s max-height';
	}
	items.style.maxHeight = h.toString() + 'px';
	
	for(i=0;i<pageButton.length;i+=1) {
		pageButton[i].className = 'goto-page';
	}
	this.className = 'goto-page active';
	
	//Refresh page numbers
	pageChooser = items.parentNode.getElementsByClassName('page-chooser')[0];
	pseudoPageNumbers = pageChooser.getElementsByClassName('pseudo-page-number');
	while(pageChooser.firstChild&&pageChooser.firstChild!=pseudoPageNumbers[0]) {
		pageChooser.removeChild(pageChooser.firstChild);
	}
	pageChooser.innerHTML = "<?php echo gettext('Pages'); ?>: " + pageChooser.innerHTML;
	pages = parseInt(pageChooser.getAttribute('data-pages'));
	pageButtonPrev = undefined;
	pageRange = Math.max(3,7-Math.min(page-1,pages-page))-1;
	for(i=1;i<=pages;i+=1) {
		pageButton = document.createElement('span');
		pageButton.innerHTML = i.toString();
		if (i==page) {
			pageButton.className = 'goto-page active';
		} else {
			pageButton.className = 'goto-page';
		}
		pageButton.addEventListener('click',gotoPage);
		pageChooser.appendChild(pageButton);
		pageButtonPrev = pageButton;
		if (i==page+pageRange&&i!=pages&&i+1!=pages) {
			//pageButton.style.marginRight = '10px';
			dots = document.createElement('span');
			dots.innerHTML = '...';
			dots.style.margin = '0 8px 0 4px';
			pageChooser.insertBefore(dots,pageButton.nextSibling);
		}
		if (i==page-pageRange&&i!=1&&i-1!=1) {
			//pageButton.style.marginLeft = '10px';
			dots = document.createElement('span');
			dots.innerHTML = '...';
			dots.style.margin = '0 8px 0 4px';
			pageChooser.insertBefore(dots,pageButton);
		}
		/*if (i==pages&&Math.abs(i-page)!=5) {
			if (typeof pageButtonPrev!='undefined'&&(pageButtonPrev.style.hasOwnProperty('marginRight')&&pageButtonPrev.style.marginRight=='10px')) {
				pageButton.style.marginLeft = '10px';
			}
		}*/
		if ((i>page+pageRange||i<page-pageRange)&&i!=1&&i!=pages) {
			pageButton.style.display = 'none';
		}
	}
	if (pseudoPageNumbers.length>=1) {
		pageButton.style.marginRight = '8px';
		for(j=0;j<pseudoPageNumbers.length;j+=1) {
			pageChooser.appendChild(pseudoPageNumbers[j]);
		}
	}
}

function pages_init(method) {
	var items;
	
	//Pages (initialization)
	items = document.getElementsByClassName('items');
	for(i=0;i<items.length;i+=1) {
		item = items[i].getElementsByClassName('item');
		
		perPage = 4;
		if (items[i].hasAttribute('data-per-page')) {
			perPage = parseInt(items[i].getAttribute('data-per-page'));
		}
		
		columns = 1;
		if (items[i].hasAttribute('data-columns')) {
			columns = parseInt(items[i].getAttribute('data-columns'));
		}
		
		extra = 0;
		if (items[i].className.indexOf('seperators')>=0) {
			extra = 1;
		}
		if (items[i].className=="games items"||items[i].className=="games-alt items") {
			extra = 3;
		}
		if (items[i].className=="users items") {
			extra = 8;
		}
		
		/*h = 0;
		for(j=0;j<item.length&&j<perPage;j+=columns) {
			h += item[j].scrollHeight + extra;
		}
		if (items[i].className.indexOf('seperators')>=0) {
			h -= 1;
		}*/
		
		/*window.setTimeout(function(items) {
			return function() {
				item = items.getElementsByClassName('item');
				
				h = -1;
				for(j=0;j<item.length&&j<perPage;j+=columns) {
					h += item[j].scrollHeight + extra;
				}
				items.style.maxHeight = h.toString() + 'px';
				
				if (item.length>=1) {
					item[item.length - 1].style.marginBottom = '1000px';
				}
			};
		}(items[i]),1000);*/
		
		pages = 0;
		for(j=0;j<item.length;j+=perPage) {
			pages += 1;
			//console.log(item[j]);
			//item[j].addEventListener('click',function () { gotoPage(items[i],1 + j/perPage) });
		}
		
		pageChooser = items[i].parentNode.getElementsByClassName('page-chooser')[0];
		if (!pageChooser) {
			pageChooser = document.createElement('div');
		} else {
			if (pageChooser.getAttribute('data-current-page')!='1') {
				//return;
				while(pageChooser.childElementCount) {
					pageChooser.removeChild(pageChooser.firstChild);
				}
				pageChooser.innerHTML = "<?php echo gettext('Pages'); ?>: ";
			}
		}
		
			pageChooser.className = 'page-chooser';
			pageChooser.innerHTML = "<?php echo gettext('Pages'); ?>: ";
			pageChooser.setAttribute('data-pages',pages.toString())
			if ((typeof items[i].parentNode.lastChild.previousSibling.tagName!='undefined')&&items[i].parentNode.lastChild.previousSibling.tagName.toLowerCase()=='form') {
				items[i].parentNode.insertBefore(pageChooser,items[i].parentNode.lastChild.previousSibling);
			} else {
				items[i].parentNode.appendChild(pageChooser);
			}
		
		for(j=0;j<item.length&&j<perPage;j+=1) {
			image = item[j].getElementsByClassName('picture-large');
			for(k=0;k<image.length;k+=1) {
				newImage = image[k].style.backgroundImage.replace('/extra-small/','/medium/').replace('/thumb/','/large/');
				if (newImage!=image[k].style.backgroundImage) {
					image[k].style.backgroundImage = newImage;
				}
			}
		}
		
		for(j=0;j<item.length;j+=columns) {
			maxh = 0;
			for(k=j;k<j+columns&&k<item.length;k+=1) {
				item[k].style.display = 'none';
				item[k].offsetHeight;
				item[k].style.display = '';
				
				maxh = Math.max(item[k].offsetHeight,maxh);
			}
			/*if (!!window.chrome&&items[i].className=="users items") {
				maxh += 2;
			} else {
				maxh += 2;
			}*/
			maxh += extra;
			for(k=j;k<j+columns&&k<item.length;k+=1) {
				if (columns>1) {
					//item[k].style.minHeight = maxh.toString() + 'px';
				}
				item[k].setAttribute('data-rowHeight',maxh.toString());
				item[k].style.marginBottom = 'initial';
				//item[k].style.verticalAlign = 'top';
			}
		}
		
		if (Math.min(perPage-1,item.length-1)>=0) {
			//console.log(Math.min(perPage-1,item.length-1));
			element = item[Math.min(perPage-1,item.length-1)];
			h = element.offsetTop + element.offsetHeight;
			/*if (typeof window.getComputedStyle!='undefined') {
				h += parseInt(getComputedStyle(item[0]).marginBottom);
			}*/
		} else {
			h = items[i].scrollTop+100;
		}
		
		items[i].style.maxHeight = h.toString() + 'px';
		console.log(h.toString() + 'px');
		
		if (item.length>=1) {
			item[item.length - 1].style.marginBottom = '1000px';
		}
		
		items[i].style.overflow = 'hidden';
		items[i].scrollTop = 0;
		if (item.length>=1) {
			items[i].scrollTop = item[0].offsetTop;
		}
		items[i].style.opacity = 1;
		pageChooser.addEventListener('click',function() {
			this.previousSibling.previousSibling.focus();
		});
		pageButtonPrev = undefined;
		for(j=1;j<=pages;j+=1) {
			pageButton = document.createElement('span');
			pageButton.innerHTML = j.toString();
			if (j==1) {
				pageButton.className = 'goto-page active';
			} else {
				pageButton.className = 'goto-page';
			}
			pageButton.addEventListener('click',gotoPage);
			pageChooser.appendChild(pageButton);
			pageButtonPrev = pageButton;
			if (j==7&&j+1!=pages) {
				//pageButton.style.marginRight = '10px';
				dots = document.createElement('span');
				dots.innerHTML = '...';
				dots.style.margin = '0 8px 0 4px';
				pageChooser.insertBefore(dots,pageButton.nextSibling);
			}
			if (j==pages&&j-1!=7) {
				if (typeof pageButtonPrev!='undefined'&&(pageButtonPrev.style.hasOwnProperty('marginRight')&&pageButtonPrev.style.marginRight=='10px')) {
					//pageButton.style.marginLeft = '10px';
					dots = document.createElement('span');
					dots.innerHTML = '...';
					dots.style.margin = '0 8px 0 4px';
					pageChooser.insertBefore(dots,pageButton);
				}
			}
			if (j>7&&j<pages) {
				pageButton.style.display = 'none';
			}
		}
		
		for(j=0;j<item.length;j+=1) {
			links = item[j].getElementsByTagName('a');
			for(k=0;k<links.length;k+=1) {
				links[k].addEventListener('focus',function(pageChooser,page) {
					return function() {
						fireEvent(pageChooser.getElementsByClassName('goto-page')[page],'click');
						//console.log(page);
					};
				}(pageChooser,Math.floor(j/perPage)));
			}
		}
		
		pseudoPageNumbers = items[i].parentNode.getElementsByClassName('pseudo-page-number');
		if (pseudoPageNumbers.length>=1) {
			pageButton.style.marginRight = '8px';
			for(j=0;j<pseudoPageNumbers.length;j+=1) {
				pageChooser.appendChild(pseudoPageNumbers[j]);
			}
		}
		
		items[i].tabIndex = '0'; //(i+100).toString();
		items[i].addEventListener('keydown',function(evt) {
			pageChooser = this.parentElement.getElementsByClassName('page-chooser')[0];
			pages = parseInt(pageChooser.getAttribute('data-pages'));
			
			if (this.hasAttribute('data-current-page')) {
				currentPage = parseInt(this.getAttribute('data-current-page'));
			} else {
				currentPage = 1;
			}
			
			newPage = currentPage;
			if (evt.which==35) {
				//End key
				if (currentPage!=pages) {
					newPage = pages;
					//this.parentElement.scrollIntoView();
					evt.preventDefault();
				}
			} else if (evt.which==36) {
				//Home key
				if (currentPage!=1) {
					newPage = 1;
					//this.parentElement.scrollIntoView();
					evt.preventDefault();
				}
			} else if (evt.which==37) {
				//Left arrow key
				if (currentPage-1>=1) {
					newPage-=1;
					//this.parentElement.scrollIntoView();
					evt.preventDefault();
				}
			} else if (evt.which==39) {
				//Right arrow key
				if (currentPage+1<=pages) {
					newPage+=1;
					//this.parentElement.scrollIntoView();
					evt.preventDefault();
				}
			}
			
			if (newPage!=currentPage) {
				fireEvent(pageChooser.getElementsByClassName('goto-page')[newPage-1],'click');
			}
		});
		
		items[i].addEventListener('touchstart',function(evt) {
			touchMove = function(xstart,ystart) {
				return function(e) {
					pageChooser = this.parentElement.getElementsByClassName('page-chooser')[0];
					pages = parseInt(pageChooser.getAttribute('data-pages'));
					
					if (this.hasAttribute('data-current-page')) {
						currentPage = parseInt(this.getAttribute('data-current-page'));
					} else {
						currentPage = 1;
					}
					
					this.style.transition = '';
					this.style.marginLeft = Math.round(Math.sign(e.changedTouches[0].pageX-xstart)*
													   Math.sqrt((Math.max(0,Math.abs(e.changedTouches[0].pageX-xstart)-32))*1600)/10)+'px';
					this.style.marginRight = (-parseInt(this.style.marginLeft))+'px';
					
					//Swipe left
					if (e.changedTouches[0].pageX<xstart-64) {
						//console.log('Swipe left');
						e.preventDefault();
						if (currentPage+1<=pages) {
							//this.style.transition = 'margin-left .1s ease 0s, margin-right .1s ease 0s';
							this.style.marginLeft = '0';
							this.style.marginRight = '0';
							fireEvent(pageChooser.getElementsByClassName('goto-page')[currentPage],'click');
							this.removeEventListener('touchmove',touchMove,false);
						}
					}
					
					//Swipe right
					if (e.changedTouches[0].pageX>xstart+64) {
						//console.log('Swipe right');
						e.preventDefault();
						if (currentPage-1>=1) {
							//this.style.transition = 'margin-left .1s ease 0s, margin-right .1s ease 0s';
							this.style.marginLeft = '0';
							this.style.marginRight = '0';
							fireEvent(pageChooser.getElementsByClassName('goto-page')[currentPage-2],'click');
							this.removeEventListener('touchmove',touchMove,false);
						}
					}
				};
			}(evt.changedTouches[0].pageX,evt.changedTouches[0].pageY);
			this.addEventListener('touchmove',touchMove);
			
			touchEnd = function(e) {
				this.style.transition = 'margin-left .2s ease 0s, margin-right .2s ease 0s';
				this.style.marginLeft = '0';
				this.style.marginRight = '0';
				this.removeEventListener('touchmove',touchMove,false);
				this.removeEventListener('touchend',touchEnd,false);
			};
			this.addEventListener('touchend',touchEnd);
			
			/*scroll = (function(items) {
				return function(e) {
					fireEvent(items,'touchend');
					console.log(items);
				};
			})(this);
			document.body.addEventListener('scroll',scroll);*/
		});
		
		/*items[i].addEventListener('focus',function(evt) {
			document.scrollIntoView(this);
		});*/
	}
}

//window.setInterval(function() {pages_init(true);},500);

function createRequestObject() {
    var http;
    if (navigator.appName == "Microsoft Internet Explorer") {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else {
        http = new XMLHttpRequest();
    }
    return http;
}

updateTimezone = function() {
	request = createRequestObject();
	request.open('GET','/timezone?offset='+(new Date()).getTimezoneOffset()+'&timezone_name='+(jstz.determine().name()),true);
	request.send();
}

updatePreview = function() {
	if (request.readyState==4&&request.status==200) {
		document.getElementById('message_preview').innerHTML = request.responseText;
		console.log(request.responseText);
	}
};

saveDraft = function() {
	saveDraftCleared = true;
	//document.getElementById('message_preview').style.opacity = '1';
	
	to = document.getElementById('message_send_to').value;
	subject = document.getElementById('message_subject').value;
	body = document.getElementById('message_body').value.replace(/\n/g,"\r\n");
	console.log('Sending: '+body);
	
	request = createRequestObject();
	request.onreadystatechange = updatePreview;
	request.open('POST','/messages/preview',true);
	request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	request.send('message[send_to]='+encodeURIComponent(to)+'&message[subject]='+encodeURIComponent(subject)+'&message[body]='+encodeURIComponent(body));
};

messageChange = function() {
	if (saveDraftCleared) {
		window.setTimeout(saveDraft,3000);
		saveDraftCleared = false;
		//document.getElementById('message_preview').style.opacity = '.5';
	}
}

saveDraftCleared = true;

//document.getElementsByClassName('search-field')[0]addEventListener('keyup',updateSearchState);

window.addEventListener('load',function() {
	/*document.getElementsByClassName('search-field')[0].addEventListener('keyup',function() {
		setTimeout(updateSearchState,200)
	})*/
	document.getElementsByClassName('search-field')[0].addEventListener('keyup',updateSearchState);
	
	inputElements = document.getElementsByTagName('input');
	for(i=0;i<inputElements.length;i+=1) {
		if (inputElements[i].type=='file') {
			inputElements[i].addEventListener('change',handleFiles);
			/*(function(element) { return fireEvent(element,'change'); })(inputElements[i]);
			window.setTimeout(function(element) {
				return function() {
					fireEvent(element,'change');
				};
			}(inputElements[i]),200);*/
		}
	}
	
	if (document.getElementById('message_body')) {
		document.getElementById('message_body').addEventListener('keyup',messageChange);
		document.getElementById('message_body').addEventListener('onchange',messageChange);
		if (document.getElementById('message_body').innerHTML!=document.getElementById('message_body').value) {
			saveDraft();
		}
	}
	
	/* ~~Strangely, the time zone is always detected wrongly now.~~ It's fixed now!
	// So now the problem is... i18n.
	times = document.getElementsByClassName('date-time');
	for(i=0;i<times.length;i+=1) {
		(function() {
			var _i = i;
			window.setTimeout(function() {
				times[_i].innerHTML = moment(new Date(times[_i].title)).fromNow().replace('a few seconds','2 seconds').replace('an ','1 ').replace('a ','1 ');
				window.setInterval(function() {
					times[_i].innerHTML = moment(new Date(times[_i].title)).fromNow().replace('a few seconds','2 seconds').replace('an ','1 ').replace('a ','1 ');
				},30000);
			},Math.random()*30000);
		}());
	}
	//*/
	
	/*
	last_active = document.getElementsByClassName('last-active');
	for(i=0;i<last_active.length;i+=1) {
		(function() {
			var _i = i;
			if (last_active[_i].getAttribute('data-datetime')!='') {
				window.setTimeout(function() {
					last_active[_i].title = 'Last active: '+moment(new Date(last_active[_i].getAttribute('data-datetime'))).fromNow().replace('a few seconds','2 seconds').replace('an ','1 ').replace('a ','1 ')+(last_active[_i].title.indexOf("\n") < 0 ? '' :last_active[_i].title.substring(last_active[_i].title.indexOf("\n")));
					window.setInterval(function() {
						last_active[_i].title = 'Last active: '+moment(new Date(last_active[_i].getAttribute('data-datetime'))).fromNow().replace('a few seconds','2 seconds').replace('an ','1 ').replace('a ','1 ')+(last_active[_i].title.indexOf("\n") < 0 ? '' :last_active[_i].title.substring(last_active[_i].title.indexOf("\n")));
					},30000);
				},Math.random()*30000);
			}
		}());
	}
	//*/
	
	notifyIcons = document.getElementsByClassName('notifications-icon');
	for(i=0;i<notifyIcons.length;i+=1) {
		notifyIcons[i].addEventListener('mouseover',function() {
			/*this.style.animationDirection = 'reverse';
			this.style.animationPlayState = 'paused';
			window.setInterval(function() {
				this.style.animationPlayState = 'running';
			},0);*/
			redNew = this.getElementsByClassName('new')[0];
			redNewCount = this.getElementsByClassName('new-count')[0];
			if (redNew) {
				bell = redNew.getElementsByClassName('fa-bell')[0];
				if (redNew.className!='new read') {
					redNew.className = 'new read';
					
					window.setTimeout(function() {
						redNew.style.animation = 'none';
						redNew.style.webkitAnimation = 'none';
						redNew.offsetWidth = redNew.offsetWidth;
						
						bell.style.animation = 'none';
						bell.style.webkitAnimation = 'none';
						bell.offsetWidth = bell.offsetWidth;
						
						str = '.3s cubic-bezier(0.16,3.25,0.5,1.13) 0s reverse forwards 1 running new-notification-icon';
						redNew.style.animation = str;
						redNew.style.webkitAnimation = str;
						
						str += '-2';
						bell.style.animation = str;
						bell.style.webkitAnimation = str;
						
						str = '.3s cubic-bezier(0.16,3.25,0.5,1.13) 0s reverse forwards 1 running new-notification-count';
						redNewCount.style.animation = str;
						redNewCount.style.webkitAnimation = str;
					},1000);
					
					console.log('notify');
				}
			}
		});
	}
	
	//Previous and next buttons
	if (!/iPad|iPod|iPhone/.test(navigator.userAgent)) {
		_prev = document.getElementsByClassName('prev');
		_next = document.getElementsByClassName('next');
		shift = document.getElementsByClassName('shift');
		for(i=0;i<shift.length;i+=1) {
			//screenshots = shift.getElementsByTagName('a');
			shift[i].parentElement.style.overflow = 'hidden';
			prev = _prev[i];
			next = _next[i];
			if (parseInt(shift[i].getAttribute('data-count'))>2) {
				if (typeof _prev[i]=='undefined') {
					prev = document.createElement('div');
					prev.className = 'prev disabled';
					shift[i].parentElement.appendChild(prev);
					
					next = document.createElement('div');
					next.className = 'next';
					shift[i].parentElement.appendChild(next);
				}
				
				next.setAttribute('data-shift',i);
				prev.setAttribute('data-shift',i);
				
				next.addEventListener('click',function() {
					for(i=0;i<2;i+=1) if (this.className=="next") {
						myShift = document.getElementsByClassName('shift')[this.getAttribute('data-shift')];
						myPrev = document.getElementsByClassName('prev')[this.getAttribute('data-shift')];
						
						myShift.style.marginLeft = (parseInt(myShift.style.marginLeft) - 50).toString() + '%';
						myPrev.className = "prev";
						if (-parseInt(myShift.style.marginLeft)/50>=myShift.getAttribute('data-count')-2) {
							this.className = "next disabled";
						}
					}
				});
				prev.addEventListener('click',function() {
					for(i=0;i<2;i+=1) if (this.className=="prev") {
						myShift = document.getElementsByClassName('shift')[this.getAttribute('data-shift')];
						myNext = document.getElementsByClassName('next')[this.getAttribute('data-shift')];
						
						myShift.style.marginLeft = (Math.min(0,parseInt(myShift.style.marginLeft) + 50)).toString() + '%';
						myNext.className = "next";
						if (myShift.style.marginLeft=='0%') {
							this.className = "prev disabled";
						}
					}
				});
				
				//console.log(shift[i]);
			} else {
				next.className = "next disabled";
				if (parseInt(shift[i].getAttribute('data-count'))==1) {
					shift[i].parentElement.getElementsByTagName('a')[0].style.width = '100%';
				}
				
				console.log(shift[i]);
			}
		}
	}
	
	pages_init(false);
});