/*---------------COUNTDOWN---------------*/
// Set the date we're counting down to
var countDownDate = new Date("Aug 1, 2021 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(
function() {
    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="countdown"
    document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "EXPIRED";
        }
}, 1000);
/*---------------------------------------*/

/*---------------NAVBAR---------------*/
// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("navbar");
    // scorrimento
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        navbar.className = "navbar1";
    }
    // Sopra 
    else {
        navbar.className = "navbar0";
    }
}
/*-------------------------------------*/

/*---------------TEXT ANIMATE---------------*/
function TextAnimate() {
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml11 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

    anime.timeline()
        .add({
        targets: '.ml11 .line',
        scaleY: [0,1],
        opacity: [0.5,1],
        easing: "easeOutExpo",
        duration: 700
    })
        .add({
        targets: '.ml11 .line',
        translateX: [0, document.querySelector('.ml11 .letters').getBoundingClientRect().width + 10],
        easing: "easeOutExpo",
        duration: 700,
        delay: 100
    })
        .add({
        targets: '.ml11 .letter',
        opacity: [0,1],
        easing: "easeOutExpo",
        duration: 600,
        offset: '-=775',
        delay: (el, i) => 34 * (i+1)
    })
        .add({
        targets: '.ml11',
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });
}
/*-------------------------------------------*/
/*---------------GET COOKIE---------------*/
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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
/*-------------------------------------------*/
function setCart() {
    price = 0;

    for (var i = document.cookie.split(';').length - 1; i >= 0 && document.cookie; i--) {
        //Prendo il cookie fra tanti    Divido il signolo cookie e prendo il nome
        a = document.cookie.split(';')[i].split('=')[0];
        a = a.replace(/ /g,'');
        if (a == "PHPSESSID")
            continue;
        data = JSON.parse(getCookie(a));
        var productAdded = '<li idProduct = ' + a + ' class="cd-cart__product"><div class="cd-cart__image"><a href="#0"><img src="'+data[0]+'" alt="placeholder"></a></div><div class="cd-cart__details"><h3 class="truncate"><a href="#0">'+data[1]+'</a></h3><span class="cd-cart__price">€'+ data[2]+'</span><div class="cd-cart__actions"><a href="#0" class="cd-cart__delete-item">Delete</a><div class="cd-cart__quantity"><label for="cd-product-'+ data[3] +'">Qty</label><span class="cd-cart__select"><select class="reset" id="cd-product-'+ data[4] +'" name="quantity"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select><svg class="icon" viewBox="0 0 12 12"><polyline fill="none" stroke="currentColor" points="2,4 6,8 10,4 "/></svg></span></div></div></div></li>';
        document.write(productAdded);
        price = Number(price) + (Number(data[2])* data[5]);

        // Select quantity
        document.getElementById('cd-product-'+ data[4]).value = data[5];
    }
}

function setCount(){
    count = 0;

    for (var i = document.cookie.split(';').length - 1; i >= 0 && document.cookie; i--) {
        //Prendo il cookie fra tanti    Divido il signolo cookie e prendo il nome
        a = document.cookie.split(';')[i].split('=')[0];
        a = a.replace(/ /g,'');
        if (a == "PHPSESSID")
            continue;
        data = JSON.parse(getCookie(a));
        count = count + data[5];
    }
    document.write(count);
}