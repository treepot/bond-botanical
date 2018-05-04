$(function() {
	$('.send').animate({'right':'40px','opacity':'1'},500).delay(5000).animate({'right':'-350px','opacity':'0'},500);
	setTimeout(function(){
		$('.send').hide();
	},6000);
	$('.send').click(function(){
		$('.send').stop().animate({'right':'-350px','opacity':'0'},500);
	});
});

/*--------------------------
　検索ボックスの空白処理
--------------------------*/
$(function() {
	$('#form').cleanQuery();
});

/*------------------
　検索ボックス
------------------*/
$(function() {
	$('.option').hide();
	$('.slctd').click(function(){
		$(this).next('.option').slideToggle(200);
	});
	$('.option').find('label').click(function(){
		$(this).parent('.option').slideUp(200);
	});
	
	$('.ams input[type="radio"]:checked').next('label').addClass('ti-check');
	var val = $('.ams input[type="radio"]:checked').val();
	if(val == 'all'){
		$('.amsSlctd').text('全て');
	}else if(val == '0'){
		$('.amsSlctd').text('未送信');
	}else if(val == '1'){
		$('.amsSlctd').text('送信済');
	};
	$('.ams input[type="radio"]').change(function() {
		var val = $(this).val();
		if(val == 'all'){
			$('.amsSlctd').text('全て');
		}else if(val == '0'){
			$('.amsSlctd').text('未送信');
		}else if(val == '1'){
			$('.amsSlctd').text('送信済');
		};
	});
	
	$('.pms input[type="radio"]:checked').next('label').addClass('ti-check');
	var val = $('.pms input[type="radio"]:checked').val();
	if(val == 'all'){
		$('.pmsSlctd').text('全て');
	}else if(val == '0'){
		$('.pmsSlctd').text('未送信');
	}else if(val == '1'){
		$('.pmsSlctd').text('送信済');
	};
	$('.pms input[type="radio"]').change(function() {
		var val = $(this).val();
		if(val == 'all'){
			$('.pmsSlctd').text('全て');
		}else if(val == '0'){
			$('.pmsSlctd').text('未送信');
		}else if(val == '1'){
			$('.pmsSlctd').text('送信済');
		};
	});
	
	$('.dms input[type="radio"]:checked').next('label').addClass('ti-check');
	var val = $('.dms input[type="radio"]:checked').val();
	if(val == 'all'){
		$('.dmsSlctd').text('全て');
	}else if(val == '0'){
		$('.dmsSlctd').text('未送信');
	}else if(val == '1'){
		$('.dmsSlctd').text('送信済');
	};
	$('.dms input[type="radio"]').change(function() {
		var val = $(this).val();
		if(val == 'all'){
			$('.dmsSlctd').text('全て');
		}else if(val == '0'){
			$('.dmsSlctd').text('未送信');
		}else if(val == '1'){
			$('.dmsSlctd').text('送信済');
		};
	});
});

/*-----------------
　メールフォーム
-----------------*/
$(function() {
	$('.mailon').click(function(){
		var id = $(this).attr('data-id');
		//console.log(id);
		$('form#'+id).parent('div.popup').fadeIn().addClass('on');
		$('.mailBg').fadeIn();
	});
	$('.mailBg').click(function(){
		$('div.popup.on').fadeOut(200).removeClass('on');
		$('.mailBg').fadeOut(200);
	});
	$('.cancel').click(function(){
		$('div.popup.on').fadeOut(200).removeClass('on');
		$('.mailBg').fadeOut(200);
	});
});


/*----------------------
　キャンセルリクエスト
----------------------*/
$(function() {
	$('.order_cancel').click(function(){
		$('form#cancelBtn').fadeIn();
		$('.cancelBg').fadeIn();
	});
	$('.cancelBg').click(function(){
		$('form#cancelBtn').fadeOut(200);
		$('.cancelBg').fadeOut(200);
	});
	$('form#cancelBtn .no').click(function(){
		$('form#cancelBtn').fadeOut(200);
		$('.cancelBg').fadeOut(200);
	});
});


/*----------------------
　グラフ
----------------------*/
$(function() {
	$('.data').children('a').each(function(){
		var delay_time = $(this).data('delay');
		$(this).delay(delay_time*100).queue(function(){
			$(this).removeClass('h0');
		});
	});
});