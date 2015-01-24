<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
        <style>
            * {        		
                    font-family: Arial,"Microsoft Sans Serif","Lucida Sans Unicode";        		
                    line-height: normal;        
                    margin: 0;        
                    padding: 0;    	
            }    	
            body {       		
                    font-size: 8pt;
                    line-height: 18px;        
                    margin: 0px;        
                    padding: 0;    	
            }
        </style>
        <script>
            var public_path = "{{ asset('') }}";
        </script>
        {{ HTML::style('js/jquery-ui/css/ui-lightness/jquery-ui-1.9.2.custom.min.css'); }}
        <!--{{ HTML::style('css/jquery.jqGrid-4.6.0/css/ui.jqgrid.css'); }}-->
        {{ HTML::script('js/jquery-1.11.2.min.js'); }}
        {{ HTML::script('js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js'); }}
        <!--{{ HTML::script('js/jquery.jqGrid-4.6.0/js/i18n/grid.locale-es.js'); }}-->
        <!--{{ HTML::script('js/jquery.jqGrid-4.6.0/js/jquery.jqGrid.min.js'); }}-->
        {{ HTML::script('js/utilidades/utilidades.js'); }}
    </head>
    <body>
