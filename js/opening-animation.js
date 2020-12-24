var one = 1000;
var two = 2000;
var three = 3000;
var next = 3500;
var read = 4000;
var five = 5000;

function headerIn () {

console.log("hello");  
document.getElementById('header').classList.add('fadeInFromLeft');
document.getElementById('site-logo').classList.add('rotate-center');
document.getElementById('indexH2').classList.add('fadeInFromTop');
document.getElementById('stuffs').classList.add('growFromMiddle');
document.getElementById('stuffs').style.display = 'flex';
// document.getElementById('skip').style.display = 'none';
setTimeout(redirectHome, three);

}

function redirectHome() {
location.href = 'home';
}




function doAllTheThings() { 


hideHeader();

function hideHeader() {
document.getElementById('header').style.opacity = '0';
setTimeout(quotesIn,two);
}

function quotesIn () {
document.getElementById('quotes').style.opacity = '1';
setTimeout(quotesOut,read);
}

function quotesOut () {
  document.getElementById('quotes').style.opacity = '0';
  setTimeout(headerIn,two);
  
  }

// function quotesOut () {
// document.getElementById('quotes').style.opacity = '0';
// setTimeout(thanksIn,next);

// }

// function thanksIn () {
// document.getElementById('thanks').style.opacity = '1';
// setTimeout(thanksOut,read);

// }

// function  thanksOut () {
// document.getElementById('thanks').style.opacity = '0';   
// setTimeout(nameIn,next);

// }

// function nameIn () {
// document.getElementById('name').style.opacity = '1';
// setTimeout(nameSpan,one);

// }

// function nameSpan () {
// document.getElementById('nameSpan').style.opacity = '1';
// setTimeout(nameSpan2,one);

// }

// function nameSpan2 () {
// document.getElementById('nameSpan2').style.opacity = '1';
// setTimeout(nameSpan3,one);

// }

// function nameSpan3 () {
// document.getElementById('nameSpan3').style.opacity = '1';
// setTimeout(nameOut,two);

// }

// function nameOut () {
// document.getElementById('name').style.opacity = '0';
// setTimeout(callMeIn,next);

// }

// function callMeIn () {
// document.getElementById('callMe').style.opacity = '1';
// setTimeout(callMeOut,next);

// }

// function callMeOut () {
// document.getElementById('callMe').style.opacity = '0';
// setTimeout(headerIn,two);

// }

                                               


}

          function skip () {

            headerIn();
             document.getElementById('animation').style.display = 'none';
           


          }
