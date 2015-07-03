function loadContacto(){
    jQuery(document).ready(function(){
        jQuery("#content_left").css({
            "top":492,
            "position":"absolute"
        });
        jQuery("#content_right").css({
            "top": 540,
            "margin-left": 200,
            "position": "absolute"
        });
    });
}
function load_menu3(contenedor){
    jQuery("#menu-trabajos ul ul").each(function(){
        x=jQuery(this).find("a:first");
        url=x.attr("href");
        jQuery(this).prev().attr("href",url);
    })
    if(jQuery("#menu-trabajos .current_page_item ul,#menu-trabajos .current_page_ancestor ul").length>0){
        jQuery("#menu-trabajos .current_page_item ul, #menu-trabajos .current_page_ancestor ul").appendTo(contenedor);
        jQuery(contenedor).find(".sep").remove();
        jQuery(contenedor).find(".children a").each(function(){
            pp='<span class="m3sep">_</span><span class="subm3">';
            jQuery(this).html(pp+jQuery(this).text()+"</span>");
        });
        title=jQuery("#menu-trabajos .current_page_item, #menu-trabajos .current_page_ancestor").html();
        jQuery(contenedor).prepend('<div id="titlem3">'+title+'</div>');
        load_gallery();
    }
}
function load_gallery(){
    if(jQuery("#menu3 .current_page_item, #menu3 .current_page_ancestor").length>0){
        cad='';
        cad+='<div id="gallerycontainer">';
        jQuery("#content_right li").each(function(){
            cad+='<img style="width:803px;height:436px;" title="'+jQuery(this).attr("title")+'" src="/tumber.php?w=803&h=436&src='+jQuery(this).text()+'" />';
        })
        cad+='</div><div id="titlethumb">'+jQuery("#menu3 .current_page_item, #menu3 .current_page_ancestor").text().substr(1, 500000)+'<br/><span></span></div><div id="gallerythumbs"></div>';
        jQuery("#content_right").html(cad);
        jQuery("#gallerycontainer").cycle({
            fx:     'fade',
            timeout: 0,
            pager:  '#gallerythumbs',
            pagerAnchorBuilder: function(idx, slide) {
                // return selector string for existing anchor
                return '<a title="'+slide.title+'" href="#"><img title="'+slide.title+'" src="'+slide.src.split("803").join("30").split("436").join("30&f=2") + '" /></a>';
            },
            before:function(curr, next, opts){
                //alert(next);
                jQuery("#titlethumb span").html(next.title);
            }
        });

    }
}
function load_scroller(){
    jq=jQuery.noConflict();
    jq(this).load(function(){
        minwidth=72;
        maxwidth=120;
        cc=jq("#scroller img").length;
        midle=Math.ceil(cc/2-1);
        maxheight=jq("#scroller img:first").height();
        //indice=jq("#scroller img").index(this);
        rzizq=Math.ceil((maxwidth-minwidth)/cc);
        rzder=Math.ceil((maxwidth-minwidth)/cc);
        animar=function(indice){
            //animo el foco
            jq("#scroller img:eq("+indice+")").animate({
                width:maxwidth,
                "margin-top":0
            }, 150, "linear", function(){});
            
            //animo izquierda
            inicio=maxwidth;
            for(i=indice-1;i>=0;i--){
                nw=inicio-rzizq;
                rz=nw/maxwidth;
                nh=Math.ceil(maxheight-maxheight*rz);
                jq("#scroller img:eq("+i+")").animate({
                    width:nw,
                    "margin-top":nh
                }, 150, "linear", function(){

                    });
                inicio-=rzizq;
            }
            //animo derecha
            inicio=maxwidth;
            for(i=indice+1;i<cc;i++){
                nw=inicio-rzizq;
                rz=nw/maxwidth;
                nh=Math.ceil(maxheight-maxheight*rz);
                jq("#scroller img:eq("+i+")").animate({
                    width:inicio-rzder,
                    "margin-top":nh
                }, 150, "linear", function(){});
                inicio-=rzder;
            }
        }
        jq("#scroller img").hover(function(){
            animar(jq("#scroller img").index(this));
        }, function(){});
        animar(midle);
    })
}