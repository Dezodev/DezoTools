jQuery(function($) {
    $(window).load(function() {
        $(document).ready(function() {
            if(php_vars.endDate){
                console.log(php_vars.endDate);
                $('div#clock').countdown(php_vars.endDate);
            }
        });
    });
});
