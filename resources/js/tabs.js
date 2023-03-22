$(document).ready(function () {

    function getAllHrefs() {
        return $('.tabs-nav a').map(function () {
            return $(this).attr('href');
        }).get();
    }


    let tab = $('.tabs-nav').find('li:first-child a').attr('href');

    if (localStorage.getItem('tabs') && jQuery.inArray(localStorage.getItem('tabs'), getAllHrefs()) === -1) {
        localStorage.removeItem('tabs');
    }

    if (localStorage.getItem('tabs')) {
        tab = localStorage.getItem('tabs');
    }


    let child = $('a[href="' + tab + '"]');

    tabsEvent(tab, child)


    function tabsEvent(tabId, this_) {
        // Remove the active class from all tabs and tab panels
        $('.tabs-nav li').removeClass('font-semibold border-gray-700');
        $('.tab-content>div').addClass('hidden');

        // Add the active class to the clicked tab and tab panel
        $(this_).parent().addClass(' font-semibold border-gray-700 ');
        $(tabId).removeClass('hidden');
    }

    $('.tabs-nav a').on('click', function () {

        // Get the ID of the tab panel
        var tabId = $(this).attr('href');

        localStorage.setItem('tabs', tabId);
        tabsEvent(tabId, this)


        // Prevent the default link behavior
        return false;
    });
});
