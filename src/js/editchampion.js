import { $, getSrcFromInput } from './functions.js';

export function initEditChampion() {
    const $inputSplashArt = $('#inputSplashArt');
    const $inputAnimatedSplashArt = $('#inputAnimatedSplashArt');
    const $imagePosition = $('#imagePosition');
    const $inputPositionX = $('#inputPositionX');
    const $inputPositionY = $('#inputPositionY');

    $inputSplashArt.addEventListener('input', () => {
        getSrcFromInput($('#imgSplashArt'), $inputSplashArt);
        $imagePosition.style.backgroundImage = `url(${$inputSplashArt.value.trim()})`;
    });

    $inputAnimatedSplashArt.addEventListener('input', () => {
        getSrcFromInput($('#videoAnimatedSplashArt'), $inputAnimatedSplashArt);
    });

    $inputPositionX.addEventListener('input', () => {
        $imagePosition.style.backgroundPositionX = `${$inputPositionX.value.trim()}%`;
    });

    $inputPositionY.addEventListener('input', () => {
        $imagePosition.style.backgroundPositionY = `${$inputPositionY.value.trim()}%`;
    });

    $("button[type='reset']").addEventListener('click', (e) => {
        $imagePosition.src = "";
        $('#imgSplashArt').src = "";
        $('#videoAnimatedSplashArt').src = "";
    });
}