function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function generateUniqueId() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }

    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
        s4() + '-' + s4() + s4() + s4();
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 10000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function checkCookie() {
    var visitor_key = getCookie('my_key');
    if(visitor_key == ''){
        visitor_key = generateUniqueId();
        setCookie('my_key', visitor_key, 365);
        console.log("Set key: " + visitor_key + "\n");
    }else{
        console.log("Key found: " + visitor_key + "\n");
        return visitor_key;
    }
}
function getVisitorKey(){
    return checkCookie();
}

function scoring_with_email(){
    if (!window.jQuery) {
        alert("no jQuery");
    } else {
        var email_from_form = document.getElementById('scoring_visitor_email').value;
        scoring(email_from_form);
    }
}

function scoring(email_from_form) {

    $.getJSON('//freegeoip.net/json/?callback=?', function (data) {

        //get all geolocations data
        var geo_ip = JSON.stringify(data.ip, null, 2);
        var geo_country_code = JSON.stringify(data.country_code, null, 2);
        var geo_region_code = JSON.stringify(data.region_code, null, 2);
        var geo_region_name = JSON.stringify(data.region_name, null, 2);
        var geo_city = JSON.stringify(data.city, null, 2);
        var geo_zip_code = JSON.stringify(data.zip_code, null, 2);
        var geo_time_zone = JSON.stringify(data.time_zone, null, 2);
        var geo_latitude = JSON.stringify(data.latitude, null, 2);
        var geo_longitude = JSON.stringify(data.longitude, null, 2);

        var project_key = scoringProjectKey();

        function getBrowserPluginsList() {
            var x = navigator.plugins.length; // store the total no of plugin stored
            var plugins_list;
            for(var i = 0; i < x; i++)
            {
                if(i == 0) plugins_list=navigator.plugins[i].name + "; ";
                else plugins_list+=navigator.plugins[i].name + "; ";
            }
            return plugins_list;
        }

        //Список установленых в браузере плагинов
        var browser_plugins_list = getBrowserPluginsList();
        //Имя браузера
        var browser_name;
        browser_name = navigator.appCodeName;
        //Движек браузера
        var browser_engine;
        browser_engine = navigator.product;
        //Версия браузера
        var browser_version;
        browser_version = navigator.appVersion;
        //Агент браузера
        var browser_agent;
        browser_agent = navigator.userAgent;
        //Язык браузера
        var browser_language;
        browser_language = navigator.language;
        //В онлайне
        var browser_online;
        browser_online = navigator.onLine;
        //Платформа браузера
        var browser_platform;
        browser_platform = navigator.platform;
        //Поддержка Java
        var browser_java;
        browser_java = navigator.javaEnabled();
        //Поддержка Cookies
        var data_cookies_enabled;
        data_cookies_enabled = navigator.cookieEnabled;
        var visitor_key = getVisitorKey();

        //Активная страница
        var page_on = window.location.pathname;
        //Пришел из страницы
        var referrer;
        referrer = document.referrer;
        //Число посещенных страниц в этой вкладке
        var history_length;
        history_length = history.length;
        //Ширина экрана
        var size_screen_w;
        size_screen_w = screen.width;
        //Высота экрана
        var size_screen_h;
        size_screen_h = screen.height;
        //Ширина документа
        var size_doc_w;
        size_doc_w = document.width;
        //Высота документа
        var size_doc_h;
        size_doc_h = document.height;
        //Ширина элемента с отступами
        var size_in_w;
        size_in_w = innerWidth;
        //Высота элемента с отступами
        var size_in_h;
        size_in_h = innerHeight;
        //Доступная ширина экрана
        var size_avail_w;
        size_avail_w = screen.availWidth;
        //Доступная высота экрана
        var size_avail_h;
        size_avail_h = screen.availHeight;
        //Глубина цвета
        var scr_color_depth;
        scr_color_depth = screen.colorDepth;
        //Разрешение экрана
        var scr_pixel_depth;
        scr_pixel_depth = screen.pixelDepth;
        //host_name
        var host_name = window.location.hostname;

        if(email_from_form) {
            var visitor_email = email_from_form;
        }

        var pathArray = location.href.split( '/' );
        var protocol = pathArray[0];
        var host = pathArray[2];
        var url = protocol + '//' + host;

        var domain = route();

        $.ajax({
            url: domain,
            type: 'GET',
            dataType: 'jsonp',
            crossDomain: true,
            data: {
                        browser_plugins_list: browser_plugins_list,
                        browser_name: browser_name,
                        browser_engine: browser_engine,
                        browser_version: browser_version,
                        browser_agent: browser_agent,
                        browser_language: browser_language,
                        browser_online: browser_online,
                        browser_platform: browser_platform,
                        browser_java: browser_java,
                        data_cookies_enabled: data_cookies_enabled,

                        page_on: page_on,
                        referrer: referrer,
                        history_length: history_length,
                        size_screen_w: size_screen_w,
                        size_screen_h: size_screen_h,
                        size_doc_w: size_doc_w,
                        size_doc_h: size_doc_h,
                        size_in_w: size_in_w,
                        size_in_h: size_in_h,
                        size_avail_w: size_avail_w,
                        size_avail_h: size_avail_h,
                        scr_color_depth: scr_color_depth,
                        scr_pixel_depth: scr_pixel_depth,
                        host_name: host_name,
                        project_key: project_key,
                        visitor_key: visitor_key,

                        geo_ip: geo_ip,
                        geo_country_code: geo_country_code,
                        geo_region_code: geo_region_code,
                        geo_region_name: geo_region_name,
                        geo_city: geo_city,
                        geo_zip_code: geo_zip_code,
                        geo_time_zone: geo_time_zone,
                        geo_latitude: geo_latitude,
                        geo_longitude: geo_longitude,

                        visitor_email: visitor_email
            }
        });

            // .error()
            // .success();
    });
}

if (!window.jQuery) {
    alert("no jQuery");
} else {
    scoring();
}