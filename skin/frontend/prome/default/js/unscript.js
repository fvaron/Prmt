$j(document).ready(function(){ 
  //----------------------------------FICHE PRODUIT---------------------------------------------
  //--------------------------------------------------------------------------------------------
  
  // LES OPTIONS
  var les_options=0;
  $j(".product-custom-option").addClass("form-control");
  $j(".product-custom-option").change(function(){
     $j(".regular-price span.price").html($j(".regular-price span.price").html().replace(",00",""));
  });
  $j(".options-personnalisables-des-produit .wrap-options:first").css({"padding-right":"10px"});

  // Compter les options du produit pour ajuster l'affichage
  $j(".wrap-options").each(function(i){ 
    les_options++;
  })
  if(les_options == 1){
    $j(".options-personnalisables-des-produit .wrap-options")
    .removeClass("col-md-6").addClass("col-md-12").css({"padding-right":"0px"});

  }

  // Enlever les décimales du prix
  if($j(".regular-price span.price").html() != undefined){
     price = $j(".regular-price span.price").html();
     $j(".regular-price span.price").html(price.replace(",00",""));
  }

  // Message de choix des options si on vient de ("achetez ou devis")
  $j("#messages_product_view").animate({"top":"300"}).hide(4000);

   
	//---------------------------------BAR DE NAVIGATION---------------------------------------------
	//--
	//-----------------------------------------------------------------------------------------------
	$j(".cfm li").mouseenter(function(){
		if(!$j(this).hasClass("home"))
		  $j(this).css({"background":"url('../../skin/frontend/prome/default/images/media/font_menu2.jpg')"});
		  $j(this).children("a").children(".menu-item-line-1").css({"color":"#fff"});
		  $j(this).children("a").children(".menu-item-line-2").css({"color":"#4c2d09"});
		 
	
	})	
	$j(".cfm li").mouseleave(function(){
	    if(!$j(this).hasClass("home"))
		  $j(this).css({"background":"none"});
	})
    
    //-------------------------------------CAROUSEL---------------------------------------------------
    //------------------------------------------------------------------------------------------------
    //                            Background next et prev du carousel
    //------------------------------------------------------------------------------------------------
	$j('.glyphicon').mouseenter(function(){
		if($j(this).hasClass('glyphicon-chevron-right'))
		  $j(this).css({"background-image":"url('../../skin/frontend/prome/default/images/media/defile_droit_gris.jpg')"})
	    else if($j(this).hasClass('glyphicon-chevron-left'))
	      $j(this).css({"background-image":"url('../../skin/frontend/prome/default/images/media/defile_gauche_gris.jpg')"})
	})	
	$j('.glyphicon').mouseleave(function(){
		if($j(this).hasClass('glyphicon-chevron-right'))
		  $j(this).css({"background-image":"url('../../skin/frontend/prome/default/images/media/defile_droit.jpg')"})
	    else if($j(this).hasClass('glyphicon-chevron-left'))
	      $j(this).css({"background-image":"url('../../skin/frontend/prome/default/images/media/defile_gauche.jpg')"})
	})

    //--------------------------------LES BLOCKS NEWS DE LA HOME-------------------------------------
    //------------------------------------------------------------------------------------------------
    //                            Les onglets du bloc News
    //------------------------------------------------------------------------------------------------
	var okVideo = 0;
	$j('.onglet').mouseenter(function(){
		if($j(this).hasClass('onglet1')){
			$j(".onglet2, .onglet3").css({"background-image":"url('../../skin/frontend/prome/default/images/media/couleur-onglet.jpg')"});
			$j(".onglet1").css({"background-image":"url('../../skin/frontend/prome/default/images/media/font_menu1.jpg')"});	
		    $j(".les-news").show();
		    $j(".les-videos, .les-autres").hide();
		}		
		if($j(this).hasClass('onglet2')){
			$j(".onglet1, .onglet3").css({"background-image":"url('../../skin/frontend/prome/default/images/media/couleur-onglet.jpg')"});
			$j(".onglet2").css({"background-image":"url('../../skin/frontend/prome/default/images/media/font_menu1.jpg')"});	
		  $j(".les-videos").show();
		  $j(".les-news, .les-autres").hide();
     
      obelement = $j(".les-videos > .une-news > .embed-responsive > kiframe");
      if (okVideo == 0) { 
        $j("div.les-videos > div.une-news >.embed-responsive").html(($j("div.les-videos > div.une-news > .embed-responsive").html()).replace("kiframe","iframe"));
      }
       okVideo = 1;
      
		}		
		if($j(this).hasClass('onglet3')){
			$j(".onglet1, .onglet2").css({"background-image":"url('../../skin/frontend/prome/default/images/media/couleur-onglet.jpg')"});
			$j(".onglet3").css({"background-image":"url('../../skin/frontend/prome/default/images/media/font_menu1.jpg')"});	
			$j(".les-autres").show();
		    $j(".les-news, .les-videos").hide();
		}
	})

    //------------------------------------ELEVATEZOOM-----------------------------------------------
    //----------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------
    $j(".photos > .product-image >img").elevateZoom();

    //--------------------------LES SMALL IMAGES DE LA FICHE PRODUIT----------------------------------
    //------------------------------------------------------------------------------------------------
    //                            Les small-img de la fiche produit
    //------------------------------------------------------------------------------------------------
    $j(".more-views>ul>li").wrapAll('<div id="content" class="col-md-10">').addClass(" col-md-4 ");
    $j(".more-views>ul").addClass('photos-small row')
                        .prepend('<div class="fleche-l col-md-1"></div>')
                        .append('<div class="fleche-r  col-md-1"></div>');
    // Pour la pagination des small images
        
    // Les small images fiche produit
    var photo_large = "";
    $j(document).on('mouseenter','.photos-small > #content  li a img',function(){
       photo_large =  $j(".photos > .product-image img").attr('src'); 
       height_large = $j(".photos >.product-image img").height();
       photo_small =  $j(this).attr("src"); //alert(photo_small);
       img_s = photo_small.split("/");
       len_s = img_s.length; 
       img_s = img_s[len_s-1]; 

       img_l = photo_large.split("/");
       len_l = img_l.length; 
       img_l = img_l[len_l-1]; 

       $j(".photos > .product-image img").height(height_large).attr('src',photo_small.replace("thumbnail/56x", "image"));
       $j(".photos > .product-image img").elevateZoom();
    })  


    //Pour la pagination des small images de la fiche produit
    var show_per_page = 3; 
    var current_page = 0;

    function set_display(first, last) {
      $j('#content').children().hide(10);
      $j('#content').children().slice(first, last).show(10);
    }    
 
    set_display(0,show_per_page);

    $j(document).on("click",".fleche-r",function(){
        if(current_page < $j("#content").children().length-3 ){
          current_page = current_page+3; 
          set_display(current_page,(current_page+3));
        }
    })
    $j(document).on("click",".fleche-l",function(){    
        if(current_page > 0 ){
          set_display(current_page-3,(current_page));
          current_page = current_page-3; 
        }
    })

    //--------------------------LES VIDEOS DE LA FICHE PRODUIT-----------------------------------------
    //-------------------------------------------------------------------------------------------------
    //------------- -----Pour la pagination des vidéos de la fiche produit-----------------------------
    var current_page_vid = 0;
    set_display_videos(0,show_per_page);

    function set_display_videos(first, last) {
      $j('#content-videos').children().hide();
      $j('#content-videos').children().slice(first, last).show();
    }
    $j(".fleche-r-vid").click(function(){   
        if(current_page_vid <= $j("#content-videos").children().length-3 ){
          current_page_vid = current_page_vid+3; 
          set_display_videos(current_page_vid,(current_page_vid+3));
        }
    })
    $j(".fleche-l-vid").click(function(){   
        if(current_page_vid > 0 ){
          set_display_videos(current_page_vid-3,(current_page_vid));
          current_page_vid = current_page_vid-3; 
        }
    })
    

    //--------------------------LA PAGE CATEGORY--------------------------------------------------
    //---------------------------------------------------------------------------------------------
    //------------- -----en savoir plus de la page catégorie-------------------------------------------
    $j(".en-savoir-plus-desc-cat").click(function(){ 
    	$j("body").prepend('<div class="flou-body"></div>');
    	var left_   = $j(this).offset().left+15;
    	$j(".description-cat").css({"top":$j(window).height()/3,
    		                        "width":"0px",
    		                        "left":$j(window).width()/2,
    		                       })
    	                      .fadeIn(10)
    	                      .animate({"left":left_,"width":"100%"},300);
    })
    $j(".close-description-cat").click(function(){
		$j(".description-cat").fadeOut(100);                      
		$j(".flou-body").remove();
    })
    $j(document).on("click",".flou-body",function(){ 
    	$j(".description-cat").fadeOut(200); 
    	$j(this).remove();
    });

})
