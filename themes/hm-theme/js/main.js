// переменные
var __hideClass = $('.author, .forget-block, .search-results__container, .wrapper--dropdownmenu, .advanced-search__hidden, .wrapper--cities-hidden, .hidden_comments, .cabinet__user__account-changer');

$(function() {

  // главный слайдер
  /*if ($(".slider__wrapper").length){
    var glide = $('.slider').glide({
          //autoplay: 4000,
          arrows: false
      });
  };*/
  
  // выпадающий список городо
  $( ".show-cities" ).click(function() {
    __hideClass.not('.wrapper--cities-hidden').hide();
    $('.wrapper--dropdownmenu').hide();
    $('.cabinet__user__account-changer').hide();
    $('.slider-text').fadeIn(200);
    $('.wrapper--cities-hidden').slideToggle(400);
    $('.show-cities').toggleClass('active');
    $(document).click(function(event) {
      if ($(event.target).closest('.wrapper--cities-hidden, .show-cities').length) return;
      $( ".wrapper--cities-hidden" ).slideUp( "slow", function() {
      // Animation complete.
      });
      event.stopPropagation();
    });
    //$('.wrapper--cities-hidden').delay(10000).slideUp( "slow", function() {
      // Animation complete.
    //});   
    return false;
  });

  // выпадающий список городо
  $( ".header-profile__ava" ).click(function() {
    __hideClass.not('.cabinet__user__account-changer').hide();
    $('.wrapper--dropdownmenu').hide();
    $('.wrapper--cities-hidden').hide();
    $('.show-cities').toggleClass('active');
    $('.cabinet__user__account-changer').fadeToggle(400);
    $(document).click(function(event) {
      if ($(event.target).closest('.cabinet__user__account-changer, .ui-menu-item').length) return;
      if($( ".cabinet__user__account-changer" ).css("display")=='block') $( ".cabinet__user__account-changer" ).fadeToggle(400);
      event.stopPropagation();
    });
    return false;
  });

  // выпадение услуг (dropmenu)
  $( ".__dropdownmenu" ).click(function() {
    __hideClass.not('.wrapper--dropdownmenu').hide();
    $('.wrapper--cities-hidden').hide();
    $('.show-cities').toggleClass('active');
    $('.cabinet__user__account-changer').hide();
    $('.slider-text').fadeIn(200);
    $('.wrapper--dropdownmenu').slideToggle(400);
    $('.__dropdownmenu').toggleClass('header-menu-primary__item--current');
    $(document).click(function(event) {
      if ($(event.target).closest('.wrapper--dropdownmenu, .__dropdownmenu').length) return;
      $( ".wrapper--dropdownmenu" ).slideUp( "slow", function() {
      // Animation complete.
      });
      event.stopPropagation();
    });
    //$('.wrapper--dropdownmenu').delay(10000).slideUp( "slow", function() {
      // Animation complete.
    //});
    return false;
  });


  //появление поиска
  $(".header-search__btn").click(function() {
    __hideClass.not('.search-results__container').hide();
    $(".search-results__container").toggle("fade");
    $('.slider-text').fadeIn(200);
    $(document).click(function(event) {
      if ($(event.target).closest('.search-results__container').length) return;
      $( ".search-results__container" ).hide("fade");
      event.stopPropagation();
    });
    return false;
  });

  //появление списка с результатами
  $( ".search-results__input" ).keyup(function() {
    if ($.trim($(this).val()).length >= 2) {
      // AJAX 
      // on ajax result
      $('.search-results__list').show( "fast", function() {
        $.ajax({
            type: "GET",
            url: "/site/search",
            data: {q: $('.search-results__input').val()},
            success: function(data) {                   
               $(".search-results__list").html(data);                   
            }
        });
      });
    }
    else {
      // AJAX 

      // on ajax result
      $('.search-results__list').hide( "fast", function() {
        // Animation complete.
        });
    }
  });
  // после очистки формы скрыть список результатов
  $(".search-results__reset").click(function() {
    $(".search-results__list").hide( "fast");
  });
  
  $( "input[name=client_phone]" ).keyup(function() {
    if ($.trim($(this).val()).length >= 2) {
      // AJAX 
      // on ajax result
      $('.order_client_phone__list').show( "fast", function() {
        $.ajax({
            type: "GET",
            url: "/crm/orders/findbyphone",
            data: {term: $('input[name=client_phone]').val()},
            success: function(data) {
               $(".order_client_phone__list").html(data);                   
            },
        });
      });
    }
    else {
      // AJAX 

      // on ajax result
      $('.order_client_phone__list').hide( "fast", function() {
        // Animation complete.
        });
    }
 });


  

  // Появление имени пользователя при наведении на Блок "Акции участников" на Главнной
  $('.action-block').mouseenter(function(){
    var block_num = parseInt($('.action-block').index(this));
    $('.action-block-user:eq(' + block_num + ')').fadeIn(350);
  });
  $('.action-block').mouseleave(function(){
    var block_num = parseInt($('.action-block').index(this));
    $('.action-block-user:eq(' + block_num + ')').fadeOut(350);
  });

  // Появление типа аккаунта при наведении на блок "Востребованные участники" на Главной
  $('.popular-block').mouseenter(function(){
    var block_num = parseInt($('.popular-block').index(this));
    $('.popular-block-account:eq(' + block_num + ')').fadeIn(100);
    $('.popular-block-img:eq(' + block_num + ')').animate({
      'top': '-35px',
      'right': '-35px',
      'width': '345px',
      'height': '350px'
    }, 550);
  });
  // Исчезание типа аккаунта при наведении
  $('.popular-block').mouseleave(function(){
    var block_num = parseInt($('.popular-block').index(this));
    $('.popular-block-account').fadeOut(100);
    $('.popular-block-img:eq(' + block_num + ')').animate({
      'top': '0',
      'right': '0',
      'width': '100%',
      'height': '100%'
    }, 550);
  });

  // Прокрутка наверх страницы
  $('.scrollup').click(function(){
    $('body, html').animate({scrollTop: 0}, 400);
    return false;
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
      $('.scrollup').fadeIn();
    } 
    else {
      $('.scrollup').fadeOut();
    }
  });


  // Текст-подсказка в инпутах
  var test = document.createElement('input');
  if (!('placehold' in test)) {
      $('input').each(function () {
          if ($(this).attr('placehold') != "" && this.value == "") {
              $(this).val($(this).attr('placehold')).on({
                         focus: function () {
                           if (this.value == $(this).attr('placehold')) {
                             $(this).val("").css('', '');
                           }
                         },
                         blur: function () {
                           if (this.value == "") {
                             $(this).val($(this).attr('placehold')).css('', '');
                           }
                         }
                     });
          }
      });
  } 


  // Появление и закрытие окна аторизации
  $('.sign, .slider-text__sign').click(function(){
    __hideClass.not('.author').hide();
    $('.author').fadeIn(200);
    $(document).click(function(event) {
      if ($(event.target).closest('.author, .sign').length) return;
      $(".author").fadeOut(200);
      $('.slider-text').fadeIn(200);
      event.stopPropagation();
    });
    return false;
  });

  // Закрытие окна  авторизации крестиком в правом верхнем углу формы
  $('.author-close').click(function(){
    $('.author').hide("fade");
    return false;
  });

  // Появление и закрытие окна "Забыли пароль?" при авторизации
  $('.forget').click(function(){
    $('.forget-block').slideToggle(400);
    $(document).click(function(event) {
      if ($(event.target).closest('.forget, .forget-block').length) return;
      $(".forget-block").hide("fade");
      event.stopPropagation();
    });
    return false;
  });

  // Проверка инпутов имейла и пароля на заполненость в окне авторизации
  /*$('.author-submit').click(function check_email_and_password() {
      var email = document.getElementById('email-input-1');   // выбираем инпут по id
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;   // такие символы и порядок должен содержать инпут
      if (!filter.test(email.value)) {    // если значение инпут НЕ равно значениям, которые могут быть
        var input = $('#email-input-1');  // выбираем нужный инпут по id
        input.addClass('invalid-input');  // добаляем класс, в котором в css прописана подсветка инпута красной границей
        input.next().fadeIn(0);   // выбираем следующий после инпута элемент - это будет сообщение о некорректности значения инпута
        input.focus(function(){   // при клике по инпуту
          input.removeClass('invalid-input');   // удаляем класс неправльно заполненного инпута - пропадает красная обводка
          input.next().fadeOut(100);    // и пропадает сообщение о некорректности
        });
        email.focus;  // это было, что значит не знаю
        return false;
      }
      // проверка поля ввода пароля на заполненность
      var password = document.getElementById('password-input-1');
      var password_value = $(password).val();
      if (password_value == '***********' || ($.trim( password_value )).length==0 ) {  // если пароль не введен или состоит из пробелов или, если равен значению плейсхолдера
        var input = $('#password-input-1');
        input.addClass('invalid-input');
        input.next().fadeIn(0);
        input.focus(function(){
          input.removeClass('invalid-input');
          input.next().fadeOut(100);
        });
        return false;
      }     
      // спрятать форму при клике по странице
      $(document).click(function(event) {
        if ($(event.target).closest('.author, .sign, .slider-text__sign').length) return;
        $(".author").fadeOut(100);
        event.stopPropagation();
      });
  }); */
  
  // убрать сообщение об ошибке в форме!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    /*$( document ).on( "click", ":submit", function() {
        var input = $('.errorMessage');
        //alert(input.css("display"));
        //if(input.css("display")!="none") {
            var par = input.parent();
            var inpt = par.children();
            inpt.addClass('invalid-input');  // добаляем класс, в котором в css прописана подсветка инпута красной границей
            inpt.next().fadeIn(0);   // выбираем следующий после инпута элемент - это будет сообщение о некорректности значения инпута
            inpt.focus(function(){   // при клике по инпуту
              inpt.removeClass('invalid-input');   // удаляем класс неправльно заполненного инпута - пропадает красная обводка
              input.fadeOut(200);    // и пропадает сообщение о некорректности
            });
        //}
    });*/
      

  // проверка имейл - инпута на заполненность в окне "Забыли пароль?"
  $('.forget-submit').click(function check_email_forget() {
      var email = document.getElementById('email-input-2');   // выбираем инпут по id
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;   // такие символы и порядок должен содержать инпут
      if (!filter.test(email.value)) {    // если значение инпут НЕ равно значениям, которые могут быть
        var input = $('#email-input-2');  // выбираем нужный инпут по id
        input.addClass('invalid-input');  // добаляем класс, в котором в css прописана подсветка инпута красной границей
        input.next().fadeIn(0);   // выбираем следующий после инпута элемент - это будет сообщение о некорректности значения инпута
        input.focus(function(){   // при клике по инпуту
          input.removeClass('invalid-input');   // удаляем класс неправльно заполненного инпута - пропадает красная обводка
          input.next().fadeOut(100);    // и пропадает сообщение о некорректности
        });
        email.focus;  // это было, что значит не знаю
        return false;
      }
      // спрятать форму "Забыли пароль?" при клике по странице
      $(document).click(function(event) {
        if ($(event.target).closest('.forget-block, .forget').length) return;
        $(".forget-block").fadeOut(0);
        event.stopPropagation();
      });
  });

  // datepicker
  $( "#datepicker, #Actions_date_start, #Actions_date_end, #search_date" ).datepicker({minDate: "0",});
  //if($( "#datepicker" ).datepicker( "isDisabled" ))
     $( "#anim" ).change(function() {
       $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
     });
     $.datepicker.regional['ru'] = {
             closeText: 'Закрыть',
             showButtonPanel: true,
             prevText: '&#x3c;Пред',
             nextText: 'След&#x3e;',
             currentText: 'Сегодня',
             monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
             'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
             monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
             'Июл','Авг','Сен','Окт','Ноя','Дек'],
             dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
             dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
             dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
             weekHeader: 'Не',
             //dateFormat: 'dd.mm.yy',
             dateFormat: 'yy-mm-dd',
             firstDay: 1,
             isRTL: false,
             showMonthAfterYear: false,
             yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['ru']);


    $( "#date_freefoto" ).datepicker();
  //if($( "#datepicker" ).datepicker( "isDisabled" ))
     $( "#anim" ).change(function() {
       $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
     });
     $.datepicker.regional['ru'] = {
             closeText: 'Закрыть',
             showButtonPanel: true,
             prevText: '&#x3c;Пред',
             nextText: 'След&#x3e;',
             currentText: 'Сегодня',
             monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
             'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
             monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
             'Июл','Авг','Сен','Окт','Ноя','Дек'],
             dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
             dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
             dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
             weekHeader: 'Не',
             //dateFormat: 'dd.mm.yy',
             dateFormat: 'yy-mm-dd',
             firstDay: 1,
             isRTL: false,
             showMonthAfterYear: false,
             yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['ru']);



  // меню с выбором
  $( "#city" ).selectmenu({ width: 210 });
  $( "#tender_city" ).selectmenu({ width: 310 });
  $( "#city_freefoto" ).selectmenu({ width: 269 });
  $( "#m_type" ).selectmenu({ width: 210 });
  $( "#genre" ).selectmenu({ width: 210 });
  $( "#tender_genre" ).selectmenu({ width: 310 });
  $( "#col__holes" ).selectmenu({ width: 366 });
  $( "#account-changer__list" ).selectmenu({ width: 277 });
  $( "#account-changer__list" ).selectmenu({ width: 277 });
  $( "#discount" ).selectmenu({ width: 269 });
  $( "#car__class" ).selectmenu({ width: 593 });
  $( "#select-1" ).selectmenu({ width: 547 });



  // выпадающий дополнительный поиск
  $( ".advanced-search__title" ).click(function() {
    __hideClass.not('.advanced-search__hidden').hide();
    $('.advanced-search__hidden').slideToggle(400);
    $(document).click(function(event) {
      if ($(event.target).closest('.advanced-search__hidden, .ui-datepicker, .ui-menu, .city_search_list, .ui-datepicker-div, .ui-datepicker-header').length) return;
      $( ".advanced-search__hidden" ).slideUp( "slow", function() {
      // Animation complete.
      });
      event.stopPropagation();
    });
    return false;
  });

  if ($(".green-btn__slide").length){
      $(".green-btn__slide").click(function(){
        $('.advanced-search__hidden').slideUp("slow");
      });
      
  }

  //появление списка с результатами по городам

  //выбор города для профайла
  $( ".search__hidden__input--city" ).keyup(function() {
    if ($.trim($(this).val()).length >= 0) {
      // AJAX 

      // on ajax result
      $('.city_search_list').show( "fast", function() {
        // Animation complete.
        });
    }
    else {
      // AJAX 

      // on ajax result
      $('.city_search_list').hide( "fast", function() {
        // Animation complete.
        });
    }
    $(document).click(function(event) {
      if ($(event.target).closest('.city_search_list, .city_search_item').length) return;
      $(".city_search_list").hide("fast");
      event.stopPropagation();
    });
    return false;
  });

  $('.city_search_item').click(function(){
    $('#user_city').val($(this).text());
    $('.city_search_list').hide('fast');
  });



  // Расширеный поиск приклеивается к верху страницы
  if ($(".wrapper--advanced-search").length){
    var start_pos = $('.wrapper--advanced-search').offset().top;
     $(window).scroll(function(){
      if ($(window).scrollTop()>=start_pos) {
        if ($('.wrapper--advanced-search').hasClass()==false) { 
          $('.wrapper--advanced-search').addClass('on-top');
        }
      }
      else {
        $('.wrapper--advanced-search').removeClass('on-top');
      }
     });
  }

  // включение паралакса
  if ($(".parallax__wrap").length){
     $.stellar({
       horizontalOffset: 50,
       verticalOffset: -550
     });
  }



    //стилизация чекбокса
    $('.checkbox_normal[type=checkbox]').xdCheckbox();
    $('input:first').xdCheckbox({disabled:true,checked:true});
    $('.add-on-cover[type=checkbox]').xdCheckbox({disabled:true,checked:true});


  //появление комментарие 
    $('.comments__view').click(function(event) {
      __hideClass.not('.hidden_comments').hide();
      $('.hidden_comments').slideToggle(400);
    });


  //взять еще фото
  /*$('.see-more').click(function(event) {
    $.get("/ajax/html/get_more_photo.html", function(data){
        $(".gallary__ajax").hide().append(data).fadeIn();
      }, "html");
  });*/

  //загрузить портфолио
  $('.__nav-accaunt__link-portfolio').click(function(event) {
    $.post("/user/getphotos", { id: $('.__nav-accaunt__link-portfolio').attr('data-id') },function(data){
        $(".accaunt-content__ajax").hide().html(data).fadeIn();
      }, "html");
    $('.wrapper-see-more').show();
    
    $('.__nav-accaunt__link-portfolio').removeClass('nav-accaunt__link');
    $('.__nav-accaunt__link-portfolio').addClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-cost').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-cost').addClass('nav-accaunt__link');
    $('.__nav-accaunt__link-calendar').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-calendar').addClass('nav-accaunt__link');
  });
  
  $('.__nav-accaunt__link-videoportfolio').click(function(event) {
    $.post("/user/getvideos", { id: $('.__nav-accaunt__link-videoportfolio').attr('data-id') },function(data){
        $(".accaunt-content__ajax").hide().html(data).fadeIn();
      }, "html");
    $('.wrapper-see-more').show();
    
    $('.__nav-accaunt__link-videoportfolio').removeClass('nav-accaunt__link');
    $('.__nav-accaunt__link-videoportfolio').addClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-cost').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-cost').addClass('nav-accaunt__link');
    $('.__nav-accaunt__link-calendar').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-calendar').addClass('nav-accaunt__link');
  });

  //загрузить цены
  $('.__nav-accaunt__link-cost').click(function(event) {
    $.post("/prices/view/", { id: $('.__nav-accaunt__link-cost').attr('data-id') }, function(data){
        $(".accaunt-content__ajax").hide().html(data).fadeIn();
      }, "html");
    $('.wrapper-see-more').hide();
    
    
    /*$('.tooltipster').tooltipster({
      trigger: 'custom',
      position: 'bottom-right',
      positionTracker: true,
      offsetX: 75,
      interactive: true,
      contentAsHTML: true,
    });*/
    
    
    $('.tooltipster').tooltipster('show');
    
    $('.tooltipster').hover(function(){
        //alert('121212');
      $('.tooltipster').tooltipster('show');
      $(document).click(function(event) {
        if ($(event.target).closest('.tooltipster, .tooltip_cost_edit').length) return;
        $('.tooltipster, .t-cls').tooltipster('hide');
        event.stopPropagation();
      });
      return false;
    });
    
    $('.tooltip_cost_edit').click(function(){
        id = origin.attr("data-set");      
        $.ajax({
            type: "POST",
            url: "/my/prices/showform/id/" + id,
            success: function(data) {                   
               $(".tooltipster-content").html(data);                   
            }
        });
        $('.tooltipster').tooltipster('show');
        $(document).click(function(event) {
          if ($(event.target).closest('.tooltipster, .tooltip_cost_edit, .default__input, .default__textarea').length) return;
          $('.tooltipster, .t-cls').tooltipster('hide');
          event.stopPropagation();
        });
        return false;
    
    });
    
    
    $('.__nav-accaunt__link-cost').removeClass('nav-accaunt__link');
    $('.__nav-accaunt__link-cost').addClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-portfolio').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-portfolio').addClass('nav-accaunt__link');
    $('.__nav-accaunt__link-videoportfolio').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-videoportfolio').addClass('nav-accaunt__link');
    $('.__nav-accaunt__link-calendar').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-calendar').addClass('nav-accaunt__link');
  });


  //загрузить календарь занятости
  $('.__nav-accaunt__link-calendar').click(function(event) {
    $.post("/user/getcalendar", { id: $('.__nav-accaunt__link-calendar').attr('data-id') },function(data){
        $(".accaunt-content__ajax").hide().html(data).fadeIn();
      }, "html");
    $('.wrapper-see-more').show();
    
    $('.__nav-accaunt__link-calendar').removeClass('nav-accaunt__link');
    $('.__nav-accaunt__link-calendar').addClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-portfolio').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-portfolio').addClass('nav-accaunt__link');
    $('.__nav-accaunt__link-videoportfolio').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-videoportfolio').addClass('nav-accaunt__link');
    $('.__nav-accaunt__link-cost').removeClass('nav-accaunt__link_active');
    $('.__nav-accaunt__link-cost').addClass('nav-accaunt__link');
  });

  // стилизация скрола
  if ($(".nano").length){
    $(".nano").nanoScroller({ 
      alwaysVisible: true,
    });
  }

  //gallery
  /*if ($(".carousel-stage").length){
    var hash = 1; // Default start index if none is specified in URL
    if (window.location.hash) {
        hash = window.location.hash;
        //alert(hash);
    }
    $('.carousel-stage').jcarousel({
                    start: hash,
                    //itemLoadCallback: curItem,
                    wrap: 'circular'
                });
    $('.carousel-navigation').jcarousel({
                    wrap: 'circular'
                });
  };

  $('.prev-navigation').jcarouselControl({
      target: '-=12'
  });

  $('.next-navigation').jcarouselControl({
      target: '+=12'
 });*/
 
  if($('.carousel-navigation').length)
  {
    $('.carousel-navigation').slick({
      infinite: true,
      slidesToShow: 12,
      slidesToScroll: 12
    });
  }
 
  //активация fancyboxq
  if ($(".gallery__zoom").length){
    $(".gallery__zoom").fancybox({
        padding : 0,
        margin  : 0,
        width   : '100%',
        height  : '100%',
        closeBtn : false,
        autoResize : true,
    });
  };
  
  if ($(".photo__zoom").length){
    $(".photo__zoom").fancybox({
        padding : 0,
        margin  : 0,
        width   : '100%',
        height  : '100%',
        closeBtn : false,
        autoResize : true,
    });
  };
  
  /*if ($(".photo__zoom").length){
    $(".photo__zoom").fancybox({
        padding : 0,
        //margin  : 0, 
    });
  };*/
  
  if ($(".avto__zoom").length){
    $(".avto__zoom").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
        padding : 0,
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});

  };
  if ($(".show_video").length){
        $(".show_video").fancybox({
    		maxWidth	: 1000,
    		maxHeight	: 800,
            width		: '90%',
    		height		: '90%',
    		autoSize	: false,
    		fitToView	: false,
            padding     : 0,
            type        : "iframe"
    	});
    }


// //добавить телефон

$('.default__input__plus-btn').click(function() {
  $('.user__tels').append('<div class="tel_blocks clfx"><div class="col-275"><label for="tel" class="default-input__label">Дополнительный телефон</label></div><div class="col-384"><input type="text" id="tel" class="default__input" placeholder="+38 0"></div></div>').hide().fadeIn('normal');
});

$('.default__input__plus-btn-tender').click(function() {
  $('.user__tels').append('<div class="default-input__container"><div class="col-181"><label for="tender-text" class="default-input__label pt4">Дополнительный<br>телефон</label></div><div class="col-674"><input type="text" id="tel" class="default__input" placeholder="+38 095 55 55 55"><div class="default__input__plus-btn-minus">-</div></div></div>').hide().fadeIn('normal');
});



$('#cabiner__gallery__select').accordion({ 
    collapsible: true,
    heightStyle: "content",
    autoHeight: true,
    active: 0
  });


  if ($("#__add-albom").length){
$('#__add-albom').modal('hide');
  };

 if ($("#__add-albom-cover").length){
  $('#__add-albom-cover').modal('hide');
  };

  $('.__crop-img').click(function(){
      var arg=this.getAttribute('data-crop');  
      //alert(this.getAttribute('data-crop'));
      $('#__crop-img-'+arg).modal('show');
      $("#target-"+arg).Jcrop({
        //aspectRatio: 0,
        allowResize: false,
        allowSelect: false,
        //onChange: updateCoords,
        setSelect:  [ 0, 0, 370, 370 ],
        onChange: function(data) {
          console.log(data);
          $('#x_'+arg).val(data.x);
          $('#y_'+arg).val(data.y);
          $('#w_'+arg).val(data.w);
          $('#h_'+arg).val(data.h);
        }
      });
  });
  

 if ($("#__accaunt_send-massage").length){
    $('#__accaunt_send-massage').modal('hide');
 };
 
 if ($("#__accaunt_video").length){
    $('#__accaunt_video').modal('hide');
 };


$('.__add-in-albom').click(function(){
  $('.hidden__albom__select').slideToggle(400);
  $(document).click(function(event) {
    if ($(event.target).closest('.hidden__albom__select').length) return;
    $( ".hidden__albom__select" ).slideUp( "slow", function() {
    // Animation complete.
    });
    event.stopPropagation();
  });
  return false;
})


/*$('.year-carousel')
       .jcarousel({
          transitions: true,
          wrap: 'circular',
          // animation: {
          //         duration: 1200,
          //         easing:   'linear',
          //         complete: function() {
          //         }
          //     }
       });

$('.year-carousel-prev').jcarouselControl({
    target: '-=1'
});

$('.year-carousel-next').jcarouselControl({
    target: '+=1'
});*/


$('.cabinet__photo__item-delete').click(function(){
  //console.log(this);
  $(this).siblings('.delete__hidden').fadeToggle(400);
});
$('.message__item-delete').click(function(){
  //console.log(this);
  $(this).siblings('.delete__hidden').fadeToggle(400);
});
$('.message__item-delete_photo').click(function(){
  //console.log(this);
  $(this).siblings('.delete__hidden').fadeToggle(400);
});

$('.delete__hidden-no').click(function(){
  $(this).parent().fadeToggle(400);
});

/*$('.delete__hidden-yes').click(function(){
  // console.log(this);
  $(this).parents('.cabinet-pro__quipment__item').fadeOut(400);
});*/


/*$('.accaunt-pro__main-slider').jcarousel({
  wrap: 'circular'
});


$('.accaunt-pro__main-slider__pagination')
           .on('jcarouselpagination:active', 'a', function() {
               $(this).addClass('active');
           })
           .on('jcarouselpagination:inactive', 'a', function() {
               $(this).removeClass('active');
           })
           .jcarouselPagination();

$('.accaunt-pro__main-slider-next').jcarouselControl({
   target: '+=1'
});*/

if ($("#horisontal-slider, .slider-2").length){
    $('#horisontal-slider, .slider-2').perfectScrollbar({
      useBothWheelAxes: true,
      suppressScrollY: true
    });
};

/*if ($(".registration__main__btn").length){
    $('.registration__main__btn').click(function(){
      $('.registration__main__btn').hide('fade');
      $('.tnx').show('fade');
    });
};*/

/*$('.horisontal-slider_1').click(function(event) {
  $.get("/ajax/html/hor_slider_1.html", function(data){
      $(".horisontal-slider__content").hide().html(data).fadeIn();
    }, "html");
  $('.horisontal-slider_1 , .horisontal-slider_2 , .horisontal-slider_3').removeClass('active');
  $('.horisontal-slider_1').addClass('active');
});

$('.horisontal-slider_2').click(function(event) {
  $.get("/ajax/html/hor_slider_2.html", function(data){
      $(".horisontal-slider__content").hide().html(data).fadeIn();
    }, "html");
  $('.horisontal-slider_1 , .horisontal-slider_2 , .horisontal-slider_3').removeClass('active');
  $('.horisontal-slider_2').addClass('active');
});

$('.horisontal-slider_3').click(function(event) {
  $.get("/ajax/html/hor_slider_3.html", function(data){
      $(".horisontal-slider__content").hide().html(data).fadeIn();
    }, "html");
  $('.horisontal-slider_1 , .horisontal-slider_2 , .horisontal-slider_3').removeClass('active');
  $('.horisontal-slider_3').addClass('active');
});*/

$('.cal_day').click(function(){
  var arg=$(this).attr('data-cel');
  if($(this).attr('data-del')==0) {
      $.ajax({
        type: "POST",
        url: "/my/calendar/add",
        data: {date:arg},
        success: function(data) {                   
           $('#'+arg).attr('data-del',1);                   
        }
      });
  }
  if($(this).attr('data-del')==1) {
      $.ajax({
        type: "POST",
        url: "/my/calendar/delete",
        data: {date:arg},
        success: function(data) {                   
           $('#'+arg).attr('data-del',0);                   
        }
      }); 
  }
  $(this).toggleClass( "reserv__day" );  
});



    $.mask.definitions['~']='[+-]';
    $(document).on("focus", "#Tenders_phone", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Tenders_phone2", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Tenders_phone3", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Users_phone", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Users_phone2", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Users_phone3", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Orders_phone", function() {
        if($('#client_phone').val() != '') {
            $(this).val($('#client_phone').val());    
        }
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Orders_phone2", function() { 
        $(this).mask("+38(999)999-99-99");
    });
    $(document).on("focus", "#Orders_phone3", function() { 
        $(this).mask("+38(999)999-99-99");
    });



    $('.accaunt_send-massage').click(function(){
       $('#send_msg').slideToggle(400); 
    });
    $('.send_msg_reset').click(function(){
       $('#send_msg').slideUp("slow"); 
    });
    
    
    /*$('#apply').click(function() {
        $('.apply').css('display','block');            
    });*/
    
    $('#content_photo .next_item').click(function(){
       var url = $(this).attr('href');
       //var img = $(this).attr('data-img');

        $.ajax({
            url:     url,
            success: function(data){
                //$('.gallery__zoom').attr('href',img);
                $('#content_photo').html(data);
            }
        });

        // А вот так просто меняется ссылка
        if(url != window.location){
            window.history.pushState(null, null, url);
        }
        
        return false; 
    });
    $(window).bind('popstate', function() {
        $.ajax({
            url:     window.location,
            success: function(data) {
                $('#content_photo').html(data);
            }
        });
    });

// конец документ реди
});
$(document).on("focus", "#Users_phone", function() { 
    $(this).mask("+38(999)999-99-99");
});
$(document).on("focus", "#Users_phone2", function() { 
    $(this).mask("+38(999)999-99-99");
});
$(document).on("focus", "#Users_phone3", function() { 
    $(this).mask("+38(999)999-99-99");
});
$(document).on("focus", "#client_phone", function() { 
    $(this).mask("+38(999)999-99-99");
});



