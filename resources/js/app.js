import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
window.$ = window.jQuery = $;

dropDownMenu($('.dropdown-menubar'))



function dropDownMenu(elem){
    elem.parent().find('.submenu-menubar').toggleClass('hidden')
    elem.find('.arrow').toggleClass('rotate-0').toggleClass('rotate-180')
}



$('.dropdown-menubar').on('click',(e)=>{
    dropDownMenu($(e.target))
})
