var nextButton = document.querySelector('.next'),
    prevButton = document.querySelector('.prev'),
    mainSection = document.querySelector('.main-home'),
    list = document.querySelector('.list'),
    item = document.querySelectorAll('.item'),
    runningTime = document.querySelector('.timeRunning')

let timeRunning = 3000
let timeAutoNext = 7000

nextButton.onclick = function(){
    showSlider('next')
}

prevButton.onclick = function(){
    showSlider('prev')
}

let runTimeOut
let runNextAuto = setTimeout(() =>{
    nextButton.click()
}, timeAutoNext)

function resetTimeAnimation() {
    runningTime.style.animation = 'none'
    runningTime.offsetHeight 
    runningTime.style.animation = null 
    runningTime.style.animation = 'runningTime 7s linear 1 forwards'
}


function showSlider(type){
    let sliderItemsDom = list.querySelectorAll('.main-home .list .item')
    if(type === 'next'){
        list.appendChild(sliderItemsDom[0])
        mainSection.classList.add('next')
    } else{
        list.prepend(sliderItemsDom[sliderItemsDom.length - 1])
        mainSection.classList.add('prev')
    }

    clearTimeout(runTimeOut)

    runTimeOut = setTimeout( () => {
        mainSection.classList.remove('next')
        mainSection.classList.remove('prev')
    }, timeAutoNext)


    clearTimeout(runNextAuto)
    runNextAuto = setTimeout(() =>{
        nextButton.click()
    }, timeAutoNext)

    resetTimeAnimation()
}

resetTimeAnimation()