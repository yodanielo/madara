var BDEI = new BDExpandingImages();

addLoadEvent(function(){
    var refreshed_content = Array('!content','next_posts','previous_posts','sidebar','comments_content','comments_title');
    bda.loadText = '<span class="loading"> Loading content, please wait ...</span>';
    bda.calculateText = '<span class="loading"> Preloading images, parsing content ...</span>';
    bda.errorText = '<span class="error"><h1>The page could not be loaded</h1><p>If you keep getting this the server can be down or somethings wrong with your connection.</span>';
    bda.imagesNotLoadedText = '<span class="loading"> Some images could not be loaded.<br/>The page will display without these images.</span>';
    bda.externalLocation = '<span class="error"><h1>External location</h1><p>I can\'t parse content from the retrieved data.<br/>The page you requested will open in a new window, and you will <a href="javascript:history.go(-1);">return to the previous page</a> shortly.<p></span>';

	
    bda.denyURLRules.push('url.contains("/wp-admin/")');
    bda.denyURLRules.push('url.contains("/feed/")');
    bda.denyURLRules.push('url.contains("/trackback/")');
    bda.denyFormRules.push('action.contains("wp-comments-post.php")');
	
    bda.addEventListener('load_complete','loadComplete');
    bda.addEventListener('load_begin','loadBegin');
	
    bda.imageLoadTimeout = 10;
    bda.transitionTweenType = Tween.regularEaseInOut;
    bda.start(refreshed_content);
	
    var images = Array();
    BDEI.width = 120;
    BDEI.height = 182;
    BDEI.classNormal = 'normal';
    BDEI.classHover = 'active';
    BDEI.scaleNormal = 0.6;
    BDEI.scaleHover = 1;
    BDEI.range = 6;
    BDEI.create('scroller_image1','scroller_image2','scroller_image3','scroller_image4','scroller_image5','scroller_image6','scroller_image7');
    BDEI.init();
    BDEI.hover(BDEI.itemIDs[3]);
	
    applyStealth();
	
    comments = bd$('comments_content_container');
    commentHandle = bd$('comments_title_container');
    commentsTween = new Tween(comments.style,'bottom',Tween.regularEaseOut,-600,-600,0,'px');
    commentHandleTween = new Tween(commentHandle.style,'right',Tween.regularEaseOut,-1600,-1600,0,'px');
    setStage();
    showCommentHandleOnLoad();
	
    showScroller();
});

window.onresize = setStage;


// center stuff etc.
function setStage(){
    var browserSize = getBrowserSize();
    var comments = bd$('comments_content_container');
    if(comments) comments.style.left = Math.round(browserSize.width/2 - 375) + 'px';
    scrollComments();
}

// eventListeners
function loadComplete(e){
    BDEI.init();
    BDEI.hover(BDEI.itemIDs[3]);
    showCommentHandleOnLoad();
    scrollComments();
    applyStealth();
}

function loadBegin(e){
    if(isCommentsOpen) doComments();
    hideCommentHandle();
}

// scroller info
function showScrollerInfo(info){
    a=info.getElementsByTagName("img");
    b=a[0].getAttribute("src");
    b=b.split("grayscale=1").join("grayscale=0");
    a[0].setAttribute("src",b);

    document.getElementById("scroller_info").innerHTML = info.lang;
}

function hideScrollerInfo(info){
    a=info.getElementsByTagName("img");
    b=a[0].getAttribute("src");
    b=b.split("grayscale=0").join("grayscale=1");
    a[0].setAttribute("src",b);
    document.getElementById("scroller_info").innerHTML = '';
}

// don't show crappy focus box when a link is clicked
function stealth(obj){
    obj.onfocus = obj.blur;
}

function applyStealth(){
    var allA = document.getElementsByTagName('a');
    for(var i = 0; i < allA.length; i++) stealth(allA[i]);
}

// comments
var isCommentsOpen = false;
var comments, commentHandle;
var commentsTween, commentHandleTween;
function doComments(){
    if(isCommentsOpen){
        commentsTween.continueTo(-600,0.5);
    }else{
        var toY = Math.round(getBrowserSize().height/2 - 250);
        commentsTween.continueTo(toY,0.5);
    }
    isCommentsOpen = !isCommentsOpen;
}

function showCommentHandle(){
    var toY = Math.round(getBrowserSize().width/2 - 230);
    commentHandleTween.continueTo(-1600 + toY,0.5);
}

function hideCommentHandle(){
    commentHandleTween.continueTo(-1600,0.5);
}

function showCommentHandleOnLoad(){
    var comments_title = bd$('comments_title')
    if(comments_title && comments_title.innerHTML.indexOf('--><!--') == -1) showCommentHandle();
}

function showViewCommentsPanel(){
    bd$('comments_view').style.display = 'block';
    bd$('comments_write').style.display = 'none';
    bd$('comments_view_a').className = 'active';
    bd$('comments_write_a').className = 'hidden';
}

function showWriteCommentPanel(){
    bd$('comments_view').style.display = 'none';
    bd$('comments_write').style.display = 'block';
    bd$('comments_view_a').className = 'hidden';
    bd$('comments_write_a').className = 'active';
}

function scrollComments(){
    if(bd$('comments_scroll_outside')) ScrollLoad ("comments_scroll_outside", "comments_scroll_inside", "1", true);
}

function hideScroller(){
    var scroller = bd$('scroller');
    var scrollLoader = bd$('scroll_loader');
    if(scroller) scroller.style.display = 'none';
    if(scrollLoader) scrollLoader.style.display = 'block';
}

function showScroller(){
    var scroller = bd$('scroller');
    var scrollLoader = bd$('scroll_loader');
    if(scroller) scroller.style.display = 'block';
    if(scrollLoader) scrollLoader.style.display = 'none';
}


// mouse wheel
/* problems with mac mightymouse. those things scroll too fast..
function handle(delta) {
	if(isCommentsOpen) return;
	if (delta < 0){
		var next = bd$('next_posts');
		next = next.getElementsByTagName('a')[0];
		if(!next) return;
		else next.onclick();
	}else{
		var next = bd$('previous_posts');
		next = next.getElementsByTagName('a')[0];
		if(!next) return;
		else next.onclick();
	}
}


function wheel(event){
	var delta = 0;
	if (!event) event = window.event;
	if (event.wheelDelta) { 
		delta = event.wheelDelta/120;
		if (window.opera) delta = -delta;
	} else if (event.detail) delta = -event.detail/3;
	if (delta) handle(delta);
	if (event.preventDefault) event.preventDefault();
	event.returnValue = false;
}

if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
window.onmousewheel = document.onmousewheel = wheel;
*/

// browser size
function getBrowserSize() {
    var myWidth = 0, myHeight = 0, o = new Object();
    if( typeof( window.innerWidth ) == 'number' ) {
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;
    } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        myWidth = document.documentElement.clientWidth;
        myHeight = document.documentElement.clientHeight;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        myWidth = document.body.clientWidth;
        myHeight = document.body.clientHeight;
    }
    o.width = myWidth;
    o.height = myHeight;
    return o;
}

function addLoadEvent(func)
{	
    var oldonload = window.onload;
    if (typeof window.onload != 'function'){
        window.onload = func;
    } else {
        window.onload = function(){
            oldonload();
            func();
        }
    }

}
