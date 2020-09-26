var s1Left = $("#s1bl");
var s1Right = $("#s1br");
var s1CurrentPage = 0;
var s1MaxPage = 0;

var s2Left = $("#s2bl");
var s2Right = $("#s2br");
var s2CurrentPage = 0;
var s2MaxPage = 0;

var s3Left = $("#s3bl");
var s3Right = $("#s3br");
var s3CurrentPage = 0;
var s3MaxPage = 0;

s1Left.click(function(){ changeContentPage(1, (s1CurrentPage-1)) });
s1Right.click(function(){ changeContentPage(1, (s1CurrentPage+1)) });

s2Left.click(function(){ changeContentPage(2, (s2CurrentPage-1)) });
s2Right.click(function(){ changeContentPage(2, (s2CurrentPage+1)) });

s3Left.click(function(){ changeContentPage(3, (s3CurrentPage-1)) });
s3Right.click(function(){ changeContentPage(3, (s3CurrentPage+1)) });

$(document).ready(function(){
    s1MaxPage = $('.first-section').length;
    console.log("sec1:"+s1MaxPage);
    if(s1MaxPage == 1 || s1MaxPage == 0) disableBothArrows(1);
    // SPRAWDZ NAJWIĘKSZY BOX -> DAJ TAKI ROZMIAR DLA WSZYSTKICH (VIP)
    var staticHeight = $('#first-section-0').css('height');
    for(a = 1; a <= s1MaxPage; a++){
        var tmpStaticHeight = $('#first-section-'+a).css('height');
        if(tmpStaticHeight > staticHeight) staticHeight = tmpStaticHeight;
    }
    for(a = 1; a <= s1MaxPage; a++){
        $('#first-section-'+a).css({"height":staticHeight});
    }
    
    s2MaxPage = $('.second-section').length - 1;//-1 ponieważ 1 wersja mobilna
    console.log("sec2:"+s2MaxPage)
    if(s2MaxPage == 1 || s2MaxPage == 0) disableBothArrows(2);
    var staticHeight = $('#second-section-0').css('height');
    for(a = 1; a <= s2MaxPage; a++){
        var tmpStaticHeight = $('#second-section-'+a).css('height');
        if(tmpStaticHeight > staticHeight) staticHeight = tmpStaticHeight;
    }
    for(a = 1; a <= s1MaxPage; a++){
        $('#second-section-'+a).css({"height":staticHeight});
    }
    
    s3MaxPage = $('.third-section').length;
    console.log("sec3:"+s3MaxPage)
    if(s3MaxPage == 1 || s3MaxPage == 0) disableBothArrows(3);
})

/*
    sectionNumber - numer sekcji, zaczynając od sekcji 1 - Aktualności do sekcji 3 - Projekty
    pageNumber - numer strony z contentem, od 0 do ?
*/

function disableBothArrows(sectionNumber){
    switch(sectionNumber){
        case 1:
            s1Left.addClass('arrow-disabled');
            s1Right.addClass('arrow-disabled');
            // Wylaczenie calkowite
            s1Left.css('opacity',0);
            s1Right.css('opacity',0);
            break;
        case 2:
            s2Left.addClass('arrow-disabled');
            s2Right.addClass('arrow-disabled');
            // Wylaczenie calkowite
            s2Left.css('opacity',0);
            s2Right.css('opacity',0);
            break;
        case 3:
            s3Left.addClass('arrow-disabled');
            s3Right.addClass('arrow-disabled');
            // Wylaczenie calkowite
            s3Left.css('opacity',0);
            s3Right.css('opacity',0);
            break;
    }
}

function disableLeftArrow(sectionNumber){
    switch(sectionNumber){
        case 1: s1Left.addClass('arrow-disabled'); break;
        case 2: s2Left.addClass('arrow-disabled'); break;
        case 3: s3Left.addClass('arrow-disabled'); break;
    }
}

function disableRightArrow(sectionNumber){
    switch(sectionNumber){
        case 1: s1Right.addClass('arrow-disabled'); break;
        case 2: s2Right.addClass('arrow-disabled'); break;
        case 3: s3Right.addClass('arrow-disabled'); break;
    }
}

function enableBothArrows(sectionNumber){
    switch(sectionNumber){
        case 1:
            s1Left.removeClass('arrow-disabled');
            s1Right.removeClass('arrow-disabled');
            break;
        case 2:
            s2Left.removeClass('arrow-disabled');
            s2Right.removeClass('arrow-disabled');
            break;
        case 3:
            s3Left.removeClass('arrow-disabled');
            s3Right.removeClass('arrow-disabled');
            break;
    }
}

function enableLeftArrow(sectionNumber){
    switch(sectionNumber){
        case 1: s1Left.removeClass('arrow-disabled'); break;
        case 2: s2Left.removeClass('arrow-disabled'); break;
        case 3: s3Left.removeClass('arrow-disabled'); break;
    }
}

function enableRightArrow(sectionNumber){
    switch(sectionNumber){
        case 1: s1Right.removeClass('arrow-disabled'); break;
        case 2: s2Right.removeClass('arrow-disabled'); break;
        case 3: s3Right.removeClass('arrow-disabled'); break;
    }
}

function changeContentPage(sectionNumber, pageNumber){
    console.log(sectionNumber + " | " +  + " | " + pageNumber);
    if(sectionNumber < 4 && sectionNumber > 0){
        var tmpCurrent = null;
        var tmpMax = null;
        var tmpPrefix = null;
        switch(sectionNumber){
            case 1: tmpCurrent=s1CurrentPage; tmpMax=s1MaxPage; tmpPrefix="#first-section-"; break;
            case 2: tmpCurrent=s2CurrentPage; tmpMax=s2MaxPage; tmpPrefix="#second-section-"; break;
            case 3: tmpCurrent=s3CurrentPage; tmpMax=s3MaxPage; tmpPrefix="#third-section-"; break;
        }
        console.log(tmpCurrent+" "+tmpMax+" "+tmpPrefix);
        if(pageNumber < tmpMax && pageNumber >= 0){
            $(tmpPrefix+tmpCurrent).hide();
            console.log(tmpPrefix+tmpCurrent+" HIDE");
            $(tmpPrefix+pageNumber).show();
            console.log(tmpPrefix+pageNumber+" SHOW");
            tmpCurrent = pageNumber;
            switch(sectionNumber){
                case 1: s1CurrentPage=tmpCurrent; break;
                case 2: s2CurrentPage=tmpCurrent; break;
                case 3: s3CurrentPage=tmpCurrent; break;
            }
            // Jeżeli current = min -> Wyłącz LEFT
            if(tmpCurrent == 0){
                //console.log("[2] => tmpCurrent == 0");
                disableLeftArrow(sectionNumber); 
                enableRightArrow(sectionNumber);
            }
            // Jeżeli current = max -> Wyłącz RIGHT
            else if(tmpCurrent == (tmpMax-1)){
                //console.log("[3] => tmpCurrent == tmpMax-1");
                disableRightArrow(sectionNumber);
                enableLeftArrow(sectionNumber)
            }
            else if(tmpCurrent != (tmpMax-1) && tmpCurrent != 0){
                //console.log("[1] => tmpCurrent != tmpMax != tmpCurrent");
                enableBothArrows(sectionNumber);
            }
            else {
                //console.log("[4] => else");
                disableBothArrows(sectionNumber);
            }
        }
    }
    
}