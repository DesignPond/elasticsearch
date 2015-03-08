<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <title></title>
    <link rel="stylesheet" href="<?php echo asset('css/annotator.min.css'); ?>">
    <link rel="stylesheet" href="http://www.admin.ch/opc/assets_v2/css/application.css">
    <link rel="stylesheet" href=" https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo asset('js/annotator-full.min.js');?>"></script>

    <script src="<?php echo asset('js/color.js');?>"></script>

    <script src="<?php echo asset('js/jquery.expose.js');?>"></script>

    <style type="text/css">
        html,body{
            background: none;
        }
        .expose-overlay {
            background:rgba(0,0,0,0.6);
            z-index: 9999;
        }
        .h1, h1 {
            font-size: 25px;
        }
        .h2, h2 {
            font-size: 21px;
            font-weight: normal;
        }
        .container{
            margin-top: 20px;
        }
        #content{
            margin-top: 20px;
        }
        #preambule h2{
            margin-bottom: 15px;
        }
    </style>
    <script>

        $(function(){


            $("#annexe").click(function(e) {
                e.preventDefault();
                var $test = $('#annexe-text'), o = $test.offset().top;
                $('html, body').animate({ scrollTop: o }, 800, function(){
                    $test.expose();
                })
            });

            $("#premabule").click(function(e) {
                e.preventDefault();
                var $test = $('#premabule-text'), o = $test.offset().top;
                $('html, body').animate({ scrollTop: o }, 800, function(){
                    $test.expose();
                })
            });


            var url  = location.protocol + "//" + location.host+"/";

            var content = $('#content').annotator();

            content.annotator('addPlugin','Color', 'Hello World');
            content.annotator('addPlugin','Tags');

            var availableTags = [
                "Loi",
                "Acte",
                "Visa",
            ];

            content.data('annotator').plugins.Tags.input.autocomplete({
                source: availableTags
            });

            //content.annotator('addPlugin', 'Categories');
            //content.annotator('addPlugin', 'MarginViewer');

            content.annotator('addPlugin', 'Store', {
                // The endpoint of the store on your server.
                prefix: url + 'api',
                // Attach the uri of the current page to all annotations to allow search.
                annotationData: { 'uri': url },
                // This will perform a "search" action when the plugin loads.
                loadFromSearch: {'limit': 20, 'uri': url}
            });

        });

    </script>

</head>
<body>

<div class="container">
    <div class="col-md-2">
        <ul class="list-group">
            <li id="premabule" class="list-group-item">Premabule</li>
            <li id="annexe" class="list-group-item">Annexe</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>
    <div class="col-md-8">
        <div id="content">
        <?php

       // echo $thecontent;

           $i = 0;

           echo '<div id="premabule-text">'.$content['preambule'].'</div>';

           $content['loi'] = array_filter($content['loi']);

           $i++;
           foreach( $content['loi'] as $contenu)
           {
               echo '<div>';
               echo (isset($contenu['title']) ?   $contenu['title'] : '');
               echo (isset($contenu['content']) ? $contenu['content'] : '');

               if(!empty($contenu['paragraphes']))
               {
                   foreach( $contenu['paragraphes'] as $paragraphes)
                   {
                       echo $paragraphes;
                   }
               }

               echo '</div>';

               $i++;
           }

           echo '<div id="annexe-text">'.$content['annexe'].'</div>';$i++;
           echo '<div>'.$content['RO'].'</div>';$i++;
           echo '<div>'.$content['notes'].'</div>';


           /*
           echo '<pre>';
           print_r($content['loi']);
           echo '</pre>';
           */

        ?>
        </div>

    </div>
    <div class="col-md-2">

    </div>
</div>

<script>
    $(function() {
        $("#demo").click(function(){
            bootstro.start(".bootstro", {
                onComplete : function(params)
                {
                    alert("Reached end of introduction with total " + (params.idx + 1)+ " slides");
                },
                onExit : function(params)
                {
                    alert("Introduction stopped at slide #" + (params.idx + 1));
                }
            });
        });
    });
</script>
</body>
</html>