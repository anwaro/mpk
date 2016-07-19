/* global url */

function fixTime(h, m){
    if(h<10){
        h = "0"+h;
    }
    if(m<10){
        m = "0"+m;
    }
    return h+":"+m;
  
}


function setDate(tomorrow){    
    var dayNumber = $('.day-number');
    var dayYear = $('.day-year');
    var dayMonth = $('.day-month');
    var dayName = $('.day-name');
    
    
    var dayNameArray = ['NIEDZIELA', 'PONIEDZIAŁEK','WTOREK', 'ŚRODA',
        'CZWARTEK', 'PIĄTEK', 'SOBOTA'];
    var dayMonthArray = ['STYCZEŃ', 'LUTY', 'MARZEC', 'KWIECIEŃ', 'MAJ',
        'CZERWIEC', 'LIPIEC', 'SIERPIEŃ', 'WRZESIEŃ', 'PAŹDZIERNIK',
        'LISTOPAD', 'GRUDZIEŃ'];
    
    dayNumber.text(tomorrow.getDate());
    dayYear.text(tomorrow.getFullYear());
    dayMonth.text(dayMonthArray[tomorrow.getMonth()]);
    dayName.text(dayNameArray[tomorrow.getDay()]);
}


function changeTime(part, add){
    var time = $('#time_start');
    if (typeof time.val() === "undefined")
        return;
    var t = time.val().split(':');
    var today = new Date();
    
   
    
    
    
    if(part === 1){
        today.setHours(parseInt(t[0])+add);
        today.setMinutes(parseInt(t[1]));
        time.val(fixTime(today.getHours(), today.getMinutes()));
    }
    else if(part===2){
        today.setHours(parseInt(t[0]));
        today.setMinutes(parseInt(t[1])+add);
        time.val(fixTime(today.getHours(), today.getMinutes()));
    }else if(part===3){
        today.setDate(today.getDate()+add);
    }else{
        today.setDate(today.getDate());
        time.val(fixTime(today.getHours(), today.getMinutes()));
    }
    
    
    //setDate(today);
    
    
}

function writeTime(evt, el){
    var string = String.fromCharCode(evt.charCode);
    
    if(el.value.length === 5 ){
        return ;
    }
    else if(string===":" && el.value.length === 1){
        el.value = "0"+ el.value + ":";
        
    }
    else if(string===":" && el.value.length === 2){
        el.value = el.value + ":";
        
    }
    else if(/\d/.test(string)){
        if(el.value.length === 2){
            el.value = el.value + ":";            
        }
        el.value = el.value + string;
        
    }
}


function wybierz_przystanek(el){
    
    el.parent().parent().find('.input-tramstop').val(el.text());
    el.parent().parent().find('.l_id').val(el.attr('id'));
    el.parent().empty();
    
}

function podpowiedzi(){    
    $('.input-tramstop').keyup(
            function(){
                pokaz_podpowiedzi($(this), $(this).parent().find('ul'));
            }
            );
}

function pokaz_podpowiedzi(el, prom){
    if(el.val().length > 1){
        $.post(url+ 'search/ajax/tramstop', { name: el.val() }, function(data){
            var data =JSON.parse(data);
            console.log(data);
            prom.empty();
            for(var i =0;i< data.length; i++){
                var newel = $('<li></li>').text(data[i][2]);
                newel.attr('id',data[i][0]) ;
                newel.click(function(){wybierz_przystanek($(this));});
                prom.append(newel);
            }
        });
        
    }else{
        prom.empty();
    }
    
    
    
}


$(function(){
    changeTime(4, 0);
    podpowiedzi();
    $("#captcha").click(function(){
        $(this).css("background","#197D62");
        $("input[type=submit]").show();
    });
});
