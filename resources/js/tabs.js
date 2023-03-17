$(document).ready(function () {
    let tab = localStorage.getItem('tabs');
    tabsEvent(tab,$('a[href="'+tab+'"]'))

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
