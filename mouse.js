(function($){
    //open help window
    Mousetrap.bind('/', function() { 
        $('#mouse').slideToggle('fast');
    });

    //open help window
    Mousetrap.bind('esc', function() { 
        $('#mouse').slideUp('fast');
    });

    //focus search box
    Mousetrap.bind('.', function() { 
        var searchBar = $('#searchbox');
        
        if(searchBar.length) {
            searchBar.focus();
        } else {
            $('#s').focus();
        }
        
        return false;
    });

    //toggle the debug-bar
    Mousetrap.bind('d', function() {
        if(typeof wpDebugBar != 'undefined') {
            wpDebugBar.toggle.visibility();
        }
    });

    //reload current page
    Mousetrap.bind('r', function() { location.reload();});

    Mousetrap.bind('g h', function() { _goto(mouse.home);}); //homepage
    Mousetrap.bind('g l', function() { _goto(mouse.list);}); //list page
    Mousetrap.bind('g s', function() { _goto(mouse.search);}); //search page


    //edit post
    Mousetrap.bind('e', function() {
        if(mouse.edit_link == null ) {
            alert('can not edit here');
            return false;
        } else {
            _goto(mouse.edit_link);
        }
    });

    /**
     * Goto a page url
     * 
     * @param page url
     */
    function _goto(url) {
        location.href = url;
    }

})(jQuery);
