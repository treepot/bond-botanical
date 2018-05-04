
/* slider */
$(function(){
	var slide = $('.slider').find('.slide');
	var total = $('.slider .slide').length -1;
	//console.log("total:"+total);
	var i = 1;
	//$('.slider .slide').css('z-index',10).addClass('zoom').hide();
	slide.eq(0).fadeIn(3000).removeClass('zoom').addClass('def').css('z-index',11);
	setInterval(function(){
		if(i!=0){slide.eq(i-1).css('z-index',10)}else{slide.eq(total).css('z-index',10)};
		slide.eq(i).fadeIn(2000).css('z-index',11).removeClass('zoom').addClass('def');
		if(i!=total){slide.eq(i+1).addClass('zoom').removeClass('def')}else{slide.eq(0).addClass('zoom').removeClass('def')};
		if(i==0){slide.eq(total-1).hide()}else if(i==1){slide.eq(total).hide()}else{slide.eq(i-2).hide()};
		if(i==total){i=0}else{i++;}
	},5000);
});

/* スムーズスクロール */
//http://qiita.com/yuking11/items/2beff13f30826ff147f0
$(function(){
  $('[data-scroll]').on('click', function() {
    var speed   = 500,
        $self   = $(this),
        $href   = $self.attr('href'),
        $margin = $self.attr('data-scroll') ? parseInt($self.attr('data-scroll')) : 0,
        $target = $($href);
    var pos = ( $target[0] && $target !== '#page_top' ) ? $target.offset().top - $margin : 0;
    $('html,body').animate({scrollTop: pos}, speed, 'swing');
    $self.blur();
    return false;
  });
});

/* navFix */
$(function(){
	
	var ww = $(window).width();
	var wh = $(window).height();
	var offset = $('header>nav').offset().top;
	
	if(ww >= 960){ // pc
		var scrollTop = $(document).scrollTop();
		if(scrollTop >= offset){
			$('header>nav').addClass('navFix');
		}else{
			$('header>nav').removeClass('navFix');
		};
		$(window).scroll(function(){
			var scrollTop = $(document).scrollTop();
			if(scrollTop >= offset){
				$('header>nav').addClass('navFix');
			}else{
				$('header>nav').removeClass('navFix');
			};
		});
		
		$('header>nav>a:not(:first-child)').show();//PCでnavを表示
	}else{
		$('header>nav>a:not(:first-child)').hide();//SPでnavを非表示
	};

	/*$(window).resize(function(){
		var ww = $(window).width();
		if(ww >= 960){ // pc
			$('header>nav>a:not(:first-child)').show();
		}else{
			$('header>nav>a:not(:first-child)').hide();
		};
	});*/
	
	/* mv logo 遅延表示 */
	//$('.mv>h1').hide();
	setTimeout(function(){
		$('.mv>h1').fadeIn(2000);
	},2000);
	
	/* パララックス */
	/*$(window).scroll(function() {
		var sc = $(this).scrollTop();
		if(sc<=wh){
			if(ww>=960){
				$('.slider').css('bottom', -sc/2)
			}else{*/
				//$('.slider').css('transform','translate3d(0,'+sc/3+'px,0)')
			/*}
		};
	});*/

/* sp */
	if(ww < 960){
		$(window).scroll(function(){
			var scrollTop = $(document).scrollTop();
			if(scrollTop > 20){
				$('.mv').next('header:not(.on)').css('top', 0);
			}else{
				$('.mv').next('header:not(.on)').css('top', -60);
			}
		});
		$('#navbtn').click(function(){
			$('header').toggleClass('on');
			$('#navbtn>i,#navbtn>span').toggle();
			$('header>nav>div').fadeToggle(300);
			$('.navCover').fadeToggle(500);
			$('.black').fadeToggle();
			$('.white').fadeToggle();
		});
		/*$('header>nav>div>a').click(function(){
			$('#navbtn>i.fa-bars,#navbtn>span.menu').show();
			$('#navbtn>i.fa-times,#navbtn>span.close').hide();
			$('header>nav').fadeOut(500);
		});*/
		
    $( 'a,img,select,input,textarea')
      .bind( 'touchstart', function(){
        $( this ).addClass( 'hover' );
    }).bind( 'touchend', function(){
        $( this ).removeClass( 'hover' );
    });
	};
});

/* Wedding Works */
$(window).on('load',function(){
      var windowHeight = $(window).height();
			var cnt = 1;
    $(".image-link.ap").each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      if (scroll > imgPos - windowHeight){
				$(this).delay(cnt*150).queue(function(){
					$(this).removeClass('ap');
				});
			cnt++;
      }
    });
  $(window).scroll(function (){
		var cnt = 1;
    $(".image-link.ap").each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      if (scroll > imgPos - windowHeight){
				$(this).delay(cnt*150).queue(function(){
					$(this).removeClass('ap');
				});
			cnt++
			}
    });
  });
});

/* map */
function initialize() {
  var latlng = new google.maps.LatLng(34.692221, 135.505104);/*表示したい場所の経度、緯度*/
  var myOptions = {
    zoom: 16, /*拡大比率*/
    center: latlng, /*表示枠内の中心点*/
    mapTypeId: google.maps.MapTypeId.ROADMAP,/*表示タイプの指定*/
		//disableDefaultUI: true
  };
  var map = new google.maps.Map(document.getElementById('bois_de_gui_map'), myOptions);
 
  /*スタイルのカスタマイズ*/
  var styleOptions = [
	{
		featureType: 'all',
		elementType: 'labels',
		stylers: [
      { gamma: '5.0' },
			{ visibility: 'off' }]
	},{
    featureType: 'transit.station',
		elementType: 'labels',
    stylers: [
      /*{ invert_lightness: true },*/
      { gamma: '0.1' },
      { visibility: 'simplified' }
    ]
  },{
    featureType: 'transit.station',
		elementType: 'geometry',
    stylers: [
      { visibility: 'simplified' },
      { color: '#DDDDDD' }
    ]
  },{
    featureType: 'landscape',
    stylers: [
      { color: '#FFFFFF' }
    ]
  },{
    featureType: "poi",
    stylers: [
      { color: "#FFFFFF" }
    ]
  },{
    featureType: 'road',
    stylers: [
      { color: '#EEEEEE' }
    ]
  },{
    featureType: 'water',
    stylers: [
      { color: '#e7efff' }
    ]
  }
];
 
 var styledMapOptions = { name: 'bois de gui' }
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('sample', sampleType);
  map.setMapTypeId('sample');
 
/*アイコンの取得*/
var icon = new google.maps.MarkerImage('https://bond-botanical.jp/img/map_logo.png',/*アイコンの場所*/
  new google.maps.Size(98,50),/*アイコンのサイズ*/
  new google.maps.Point(0,0),/*アイコンの位置*/
	new google.maps.Point(90,50) // anchor
);
 
/*マーカーの設置*/
var markerOptions = {
  position: latlng,/*表示場所と同じ位置に設置*/
  map: map,
  icon: icon,
  title: 'bois de gui'/*マーカーのtitle*/
};
var marker = new google.maps.Marker(markerOptions);
 
};

/* Order */
$(function() {
	$('.cartjs_cart_in').children('input').attr('type','submit').val('Add to cart');
	$('.cartjs_buy').find('input').val('Add to cart').attr('style','');
	$('.quantity').children('select').change(function(){
		var qu = $(this).val();
		//console.log(qu);
		$('input.cartjs_product_input_txt,.cartjs_quantity>input').attr('value',qu);
	});
	$('.type').children('select').change(function(){
		window.location.href = $(this).val()+'.php';
	});
	
	
});

/* form */
$(function() {
	$('#contact > #form').find('.selectArea > select').change(function() {
			$(this).css('border-color', '');
			$('#form').find('.selectArea').children('span').css('opacity', '');
	});
  $('#contact > #form').submit(function() {
		var selected = $(this).find('.selectArea > select').val();
		var top_pos = $(this).find('.selectArea > select').offset().top - 85;
		if(selected == 0){
			$(this).find('.selectArea > select').css('border-color', '#E55');
			$(this).find('.selectArea').children('span').css('opacity', 1);
			$("html, body").animate({ scrollTop: top_pos }, 'fast','swing');
    	return false;// POST送信を中断
		};
  });
	
	$('#order_sheet > #form').find('input, textarea').change(function() {
		$(this).removeClass('empty');// 入力されたらremove.empty
		$('#order_sheet > #form').children('div').find('input.required, textarea.required').each(function() {
			var val = $(this).val();
			if(val != 0){
				$(this).removeClass('empty');
			};      
    });// 入力された欄以外も同時にチェック(郵便番号入力で住所が自動入力されるため)
	});
	
  $('#order_sheet > #form').submit(function() {
		var flower_type = $('input[name="flower_type"]:checked').val();
		if(flower_type == "0"){
			$('.err>.flower_type_err').show();
		}else{
			$('.err>.flower_type_err').hide();
		};
		var flower_color = $('input[name="flower_color"]:checked').val();
		if(flower_color == "0"){
			$('.err>.flower_color_err').show();
		}else{
			$('.err>.flower_color_err').hide();
		};
		var transfer = $('input[name="transfer"]:checked').val();
		if(transfer == "0"){
			$('.err>.transfer_err').show();
		}else{
			$('.err>.transfer_err').hide();
		};
		$(this).children('div').find('input.required, textarea.required').each(function() {
			var val = $(this).val();
			if(val == 0){
				$(this).addClass('empty');
			}else{
				$(this).removeClass('empty');
			};
		});// submitされたら、空欄の.requiredに.emptyを付与
		var email = $('input[name="email"]').val();
		var email_comf = $('input[name="email_comf"]').val();
		if(email != email_comf){
			$('input[name="email_comf"]').css('border-color', '#E55');
			$('.err>.email_err').show();
		}else{
			$('.err>.email_err').hide();
		};
		if($('.empty').length || email != email_comf){
			console.log('必須入力項目が' + $('.empty').length + '項目残っているため送信が中断されました')
			if($('.empty').length){
				$('.err>.empty_err').show();
			}else{
				$('.err>.empty_err').hide();
			};
			$("html,body").animate({scrollTop:0},"300");
			return false;// POST送信を中断
		};
	});
});

/* wp */
$(function() {
	var wpstr = $('h1.page-title').text().replace(/カテゴリー: /g, '');
	$('h1.page-title').text(wpstr);
	$('time').each(function() {
		var timestr = $(this).text().replace(/月/g, 'Mon.').replace(/火/g, 'Tue.').replace(/水/g, 'Wed.').replace(/木/g, 'Thu.').replace(/金/g, 'Fri.').replace(/土/g, 'Sat.').replace(/日/g, 'Sun.');
		$(this).text(timestr);
  });
	$('time').next('time.updated').each(function() {
		var updatestr = $(this).text();
		$(this).text('Update : ' + updatestr);
	});
	$('time').each(function() {
		$(this).unwrap('a');
	});
	$('h2.entry-title').each(function() {
		var this_ttl = $(this).children('a').text();
		$(this).empty().text(this_ttl);
	});
	$('.nav-links').children('a.next').text('NEXT');
	$('.nav-links').children('a.prev').text('PREV');
	$('.nav-links').children('a.page-numbers').each(function() {
    var wphref = $(this).attr('href').replace('inc/wp/bois_de_gui/', '');
		$(this).attr('href',wphref);
  });
});


/* loading */
$(function() { //5秒経ったら強制表示
	//console.log('ready');
	setTimeout(function(){
		$('.category-2>*:not(.loading), .category-3>*:not(.loading)').css('opacity', 1);
		$('body').removeClass('hide');
		$('.loading').fadeOut();
		//console.log('go');
	},5000);
});

$(window).on('load',function(){
	$('.category-2>*:not(.loading), .category-3>*:not(.loading)').css('opacity', 1);
	$('body').removeClass('hide');
	$('.loading').fadeOut();
});