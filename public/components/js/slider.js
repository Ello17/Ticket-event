
let slider = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.slider .dots li');

let slidertwo = document.querySelector('.slidertwo .listtwo');
let itemstwo = document.querySelectorAll('.slidertwo .listtwo .itemtwo');
let nexttwo = document.getElementById('nexttwo');
let prevtwo = document.getElementById('prevtwo');
let dotstwo = document.querySelectorAll('.slidertwo .dotstwo li');


let lengthItems = items.length - 1;
let active = 0;
next.onclick = function(){
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
}
prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
}
let refreshInterval = setInterval(()=> {next.click()}, 3000);
function reloadSlider(){
    slider.style.left = -items[active].offsetLeft + 'px';
    //
    let last_active_dot = document.querySelector('.slider .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(()=> {next.click()}, 3000);


}

dots.forEach((li, key) => {
    li.addEventListener('click', ()=>{
         active = key;
         reloadSlider();
    })
})
window.onresize = function(event) {
    reloadSlider();
};


let lengthItemstwo = items.length - 1;
let activetwo = 0;
nexttwo.onclick = function(){
    activetwo = activetwo + 1 <= lengthItemstwo ? activetwo + 1 : 0;
    reloadSlidertwo();
}
prevtwo.onclick = function(){
    activetwo = activetwo - 1 >= 0 ? activetwo - 1 : lengthItemstwo;
    reloadSlidertwo();
}
let refreshIntervaltwo = setInterval(()=> {next.click()}, 3000);
function reloadSlidertwo(){
    slidertwo.style.left = -itemstwo[activetwo].offsetLeft + 'px';
    //
    let last_active_dot = document.querySelector('.slidertwo .dotstwo li.activetwo');
    last_active_dot.classList.remove('activetwo');
    dotstwo[activetwo].classList.add('activetwo');

    clearInterval(refreshIntervaltwo);
    refreshIntervaltwo = setInterval(()=> {nexttwo.click()}, 3000);


}

dotstwo.forEach((li, key) => {
    li.addEventListener('click', ()=>{
         activetwo = key;
         reloadSlidertwo();
    })
})
window.onresize = function(event) {
    reloadSlidertwo();
};
