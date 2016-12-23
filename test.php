<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.useso.com/js/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
<script type="text/javascript" src="jsq/pagination.js"></script>
<link href="css/pagination.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id ="pagination"></div>

</body>
<script type="text/javascript">
$(function(){

    function createDemo(name){
        var container = $('#pagination-' + name);
        var sources = function(){
            var result = [];

            for(var i = 1; i < 196; i++){
                result.push(i);
            }

            return result;
        }();

        var options = {
            dataSource: sources,
            className: 'paginationjs-theme-blue',
            callback: function(response, pagination){
                window.console && console.log(response, pagination);

                var dataHtml = '<ul>';

                $.each(response, function(index, item){
                    dataHtml += '<li>'+ item +'</li>';
                });

                dataHtml += '</ul>';

                container.prev().html(dataHtml);
            }
        };

        //$.pagination(container, options);

        container.addHook('beforeInit', function(){
            window.console && console.log('beforeInit...');
        });
        container.pagination(options);

        container.addHook('beforePageOnClick', function(){
            window.console && console.log('beforePageOnClick...');
            //return false
        });

        return container;
    }

    createDemo('demo1');

});
</script>
</html>


