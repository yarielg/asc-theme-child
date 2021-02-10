jQuery(function($) {

    $(document).ready(function() {

        //Adding New event
        $(document).on('click', '#asc-event.actionable, .asc-event.actionable', function(){
            var id = $(this).data('eventid');
            var altru = $(this).data('altru');
            var mainurl = $(this).data('mainurl');
            var type = $(this).data('type');
            var date = $(this).data('date');
            var _self = this;
            $.ajax( {
                type: 'POST',
                url:  parameters.ajax_url,
                data:{
                    'action':'asc_add_event',
                    'id': id
                },
                dataType: "json",
                beforeSend: function () {
                    /*$(".wrpl_loader").css("display", "block");
                    $("#modal-overlay").show();*/
                },
                complete: function () {
                    /*$(".wrpl_loader").css("display", "none");
                    $("#modal-overlay").hide();*/
                },
                success: function (obj) {
                    var data = obj.data
                    if(!obj.success){
                        alert('Error, This event is already in your list');
                    }else{
                        $('.no-event-on-list').css('display','none');
                        $(_self).addClass('disabled');
                        $(_self).removeClass('actionable');
                        $(_self).find('span').remove();
                        if($(_self).hasClass('no-text')){
                            $(_self).append('<span><i class="fa fa-check"></i></span>');
                        }else{
                            $(_self).append('<span><i class="fa fa-check"></i> Added</span>');
                        }

                        if(type == 'featured'){

                            $('.asc-featured-addons').append('<div class="row mb-2 asc-event-row featured" id="asc-event-'+data.id+'">\n' +
                                '                                    <div class="col-3 p-0">\n' +
                                '                                        <img style="width: 80px;height: 80px" src="'+data.url+'" alt="">' +
                                '                                    </div>' +
                                '                                    <div class="col-7"><h6 class="asc-adventure-title">' + data.event_name + '</h6> <p class="asc-date">'+date+'</p></div>' +
                                '                                    <div class="col-2 px-0">' +
                                '                                        <a href="#" class="asc-remove-event" data-type="' + data.type + '" data-eventid="' + data.id + '"><i class="fa fa-trash"></i></a>' +
                                '                                    </div>' +
                                '                                </div>');
                            $('.asc-featured-addons').append('<div class="row asc-buy-general-admission" id="asc-buy-list-btn-'+ id +'" style="display: flex">' +
                                '                                    <div class="col p-0 mb-2">' +
                                '                                        <a href="javascript: void(0)" id="asc-buy-' + data.id + '" data-url="' + altru +'" data-eventid="' + data.id + '" class="asc_btn_cta blue mt-3 float-right"><span class="cta-asc-text"><img src="'+mainurl+'" alt=""> BUY TICKET</span></a>' +
                                '                                    </div>' +
                                '                                </div>');
                            $('.asc-buy-general-admission').css('display','flex');
                            $('#asc-title-featured-modal').css('display','block');
                        }
                        else if(type == 'general'){
                            $('#asc-general-rows-container').append('<div class="row mb-2 asc-event-row general" id="asc-event-'+data.id+'">\n' +
                                '                                    <div class="col-3 p-0">\n' +
                                '                                        <img style="width: 80px;height: 80px" src="'+data.url+'" alt="">' +
                                '                                    </div>' +
                                '                                    <div class="col-7"><h6 class="asc-adventure-title">' + data.event_name + '</h6> <p class="asc-date">'+date+'</p></div>' +
                                '                                    <div class="col-2 px-0">' +
                                '                                        <a href="#" class="asc-remove-event" data-type="' + data.type + '" data-eventid="' + data.id + '"><i class="fa fa-trash"></i></a>' +
                                '                                    </div>' +
                                '                                </div>');
                            $('#asc-title-general-modal').css('display','block');
                            $('#asc-buy-list-btn-general').css('display','block');
                        }else{
                            $('.asc-simple-event').append('<div class="row mb-2 asc-event-row" id="asc-event-'+data.id+'">\n' +
                                '                                    <div class="col-3 p-0">\n' +
                                '                                        <img style="width: 80px;height: 80px" src="'+data.url+'" alt="">' +
                                '                                    </div>' +
                                '                                    <div class="col-7"><h6 class="asc-adventure-title">' + data.event_name + '</h6> <p class="asc-date">'+date+'</p></div>' +
                                '                                    <div class="col-2 px-0">' +
                                '                                        <a href="#" class="asc-remove-event" data-type="' + data.type + '" data-eventid="' + data.id + '"><i class="fa fa-trash"></i></a>' +
                                '                                    </div>' +
                                '                                </div>');

                        }
                        //Showing My itinerary when adding an event
                        $('.asc-itinerary').css('display','block');
                    }
                },
                error : function(jqXHR, exception){
                    alert('Error, try to add the event again');
                }

            });
        });

        //Removing an event from My Adventure List
        $(document).on('click', '.asc-event-rows .asc-remove-event', function(){
            var id = $(this).data('eventid');
            var type = $(this).data('type');
            var _self = this;

            $.ajax( {
                type: 'POST',
                url:  parameters.ajax_url,
                data:{
                    'action':'asc_remove_event',
                    'id': id
                },
                dataType: "json",
                beforeSend: function () {
                    $(".asc-event-mask").css("display", "block");
                   /* $("#modal-overlay").show();*/
                },
                complete: function () {
                    $(".asc-event-mask").css("display", "none");
                    /*$("#modal-overlay").hide();*/
                },
                success: function (data) {
                    $('#asc-event-'+id).remove();

                    //Changing the status for the single event button
                    $asc_btn = $('#asc-event');
                    $asc_btn.removeClass('disabled');
                    $asc_btn.addClass('actionable');
                    $asc_btn.find('span').remove();
                    $asc_btn.append('<span class="cta-asc-text"><i class="fa fa-plus"></i> Add to my Adventure</span>');

                    //Changing the icon and status or the vent in the modal list
                    $asc_icon_btn_added = $('.asc-event-' + id);
                    $asc_icon_btn_added.removeClass('disabled');
                    $asc_icon_btn_added.addClass('actionable');
                    $asc_icon_btn_added.find('span').remove();
                    $asc_icon_btn_added.append('<span class="cta-asc-text"><i class="fa fa-plus"></i></span>');
                    if(asc_count_rows() > 0){
                        $('.no-event-on-list').css('display','none');

                    }else{
                        $('.no-event-on-list').css('display','block');
                        $('.asc-itinerary').css('display','none');
                    }
                    if( asc_count_rows_featured() == 0){
                        $('#asc-title-featured-modal').css('display','none');
                    }
                    if( asc_count_rows_general() == 0){
                        $('#asc-title-general-modal').css('display','none');
                        $('#asc-buy-list-btn-general').css('display','none');
                    }

                    //Removing buy button from the list
                    $('#asc-buy-list-btn-'+id).remove();
                },
                error : function(jqXHR, exception){
                    alert('Error, try to add the vent again');
                }

            });
        });

        //Removing an event in redirection
        $(document).on('click', '#asc-buy', function(){
            var id = $(this).data('eventid');
            var url = $(this).data('url');
            var _self = this;

            $.ajax( {
                type: 'POST',
                url:  parameters.ajax_url,
                data:{
                    'action':'asc_remove_event_redirection',
                    'id': id
                },
                dataType: "json",
                beforeSend: function () {
                    $(".asc-event-mask").css("display", "block");
                    /* $("#modal-overlay").show();*/
                },
                complete: function () {
                    $(".asc-event-mask").css("display", "none");
                    /*$("#modal-overlay").hide();*/
                },
                success: function (data) {
                    window.location.href = url;

                },
                error : function(jqXHR, exception){
                    alert('Error, try to add the vent again');
                }

            });
        });

        //Key up event (search posts)
        $('#asc-main-search').on('keyup', function(){
            var term = $(this).val();

            $.ajax( {
                type: 'POST',
                url:  parameters.ajax_url,
                data:{
                    'action':'asc_get_posts',
                    'term' : term
                },
                dataType: "json",
                beforeSend: function () {
                    $(".asc-event-mask").css("display", "block");
                    /* $("#modal-overlay").show();*/
                },
                complete: function () {
                    $(".asc-event-mask").css("display", "none");
                    /*$("#modal-overlay").hide();*/
                },
                success: function (json) {
                    var posts = json.data.posts;
                    $result_container = $('.asc-results-search');
                    $result_container.empty();
                    var html = '';
                    for(var i = 0; i < posts.length; i++){ //asdasd
                        $result_container.append('<div class="row asc-search-rows mb-3">\n' +
                            '                            <a href="'+ posts[i]['link'] +'"><h5 class="col-12">' + posts[i]["post_title"]+'</h5></a><br>\n' +
                            '                            <p class="col-12">' + posts[i]["overview"]+'</p>\n' +
                            '                        </div>');
                    }

                },
                error : function(jqXHR, exception){
                    alert('Error, try to add the vent again');
                }

            });
        });

        //Save intinerary
        $('#asc-save-itinerary-btn').on('click', function(){
            $(this).css('display','none');
            $('#asc-intinerary-section').css('display','block');
        });

        $('#asc-close-save-itinerary').on('click', function(){
            $('#asc-save-itinerary-btn').css('display','flex');
            $('#asc-intinerary-section').css('display','none');
        });

        //Send My adventure email
        $('#asc-submit-adventure').on('click', function(){
            if($('#asc-intinerary-section').valid()){
                /*var id = $(this).data('eventid');
                var url = $(this).data('url');*/
                var _self = this;
                var email = $('#asc-submit-email').val();

                $.ajax( {
                    type: 'POST',
                    url:  parameters.ajax_url,
                    data:{
                        action: 'asc_send_adventure_email',
                        email: email
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $(".asc-event-mask").css("display", "block");
                    },
                    complete: function () {
                        $(".asc-event-mask").css("display", "none");
                    },
                    success: function (data) {
                        $('#asc-save-itinerary-btn').css('display','flex');
                        $('#asc-intinerary-section').css('display','none');
                        $('#asc-submit-email').val('');

                    },
                    error : function(jqXHR, exception){
                        alert('Error, Your adventure was not emailed, try again');
                    }

                });
            }else{
                alert('Please, enter a valid email!');
            }
        });
            //preventing the form submission
        $("#asc-intinerary-section").submit(function(e){
            e.preventDefault();
        });

        //Counting Event Row
        function asc_count_rows(){
            return $('.asc-event-row.on-list').length;
        }

        //Counting Event Row Featured
        function asc_count_rows_featured(){
            return $('.asc-event-row.on-list.featured').length;
        }

        //Counting Event Row General
        function asc_count_rows_general(){
            return $('.asc-event-row.on-list.general').length;
        }

        //Plan My adventure accordion
        $( "#plan-accordion" ).accordion({
           // icons: { "header": "fa fa-caret-right", "activeHeader": "fa fa-caret-down" }
            icons : false
        });

        $('.ui-accordion-header').on('click', function(){
           // if(!$(this).hasClass('ui-accordion-header-active')){
            $('.ui-accordion-header i').removeClass('fa-caret-down').addClass('fa-caret-right');
            $(this).find('i').removeClass('fa-caret-right').addClass('fa-caret-down');
            /*}else{
                $(this).find('i').removeClass('fa-caret-down').addClass('fa-caret-right');
            }*/
        });
        /**
         * Customizing datepicker for events
         */
        $( "#tribeevent-datepicker" ).datepicker({
            showOn: "button",
            //dateFormat: 'DD, MM yy',
            // Button image stored on local device
            buttonImage: "../wp-content/themes/wp-bootstrap-starter-child-master/assets/img/calendar.svg",
            buttonImageOnly: true,
            nextText:'>',
            prevText:'<',
            beforeShow: function(){
                setTimeout( function(){
                    /*btns = $('.ui-datepicker-header > a');
                    $('.ui-datepicker-header > a').remove();

                    $('#ui-datepicker-div').append($btns);*/
                },100);
            }
        });
        $('#ui-datepicker-div .ui-datepicker-next').addClass('fa').addClass('fa-caret-right');
        $('#menu-main-menu li.dropdown-toggle a').click(function(){
            if($(this).attr('href') != '#'){
                window.location.href = $(this).attr('href');
            }
        });

        /*Help Card */
        $('.asc-help-card').on('click', function(e) {
            var href = $(this).find('a.vce-icon-button').attr('href');
            window.location = href;
            /*e.stopPropagation();
            e.preventDefault();
            alert($(this).find(a).attr('href'));*/
        });
        $('.page404').find('.search-submit').removeClass('btn').removeClass('btn-default');
        /** Sidebar menu */
        /*
        $("<select id='fancy_selectbox' />").appendTo(".side_menu_cls ul.menu");
        $("<option />", {
            "selected": "selected",
            "value"   : "",
            "text"    : "Go to..."
            }).appendTo(".side_menu_cls ul.menu select");

            
            $(".side_menu_cls ul.menu li a").each(function() {
            var el = $(this);
            $("<option />", {
                "value"   : el.attr("href"),
                "text"    : el.text()
            }).appendTo("ul.menu select");
        });

        $(".side_menu_cls ul.menu select").change(function() {
            window.location = $(this).find("option:selected").val();
        });
        */
        /** Sidebar menu */
        jQuery('<span class="arrow_ic"></span>').insertBefore( ".menu-item-has-children .sub-menu" );
        jQuery('.current-menu-item .arrow_ic').click(function() {
          jQuery(this).next().slideToggle();
        });


	$('#menu-item-35').find('a').removeAttr('data-toggle');
    });
});
