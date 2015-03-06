<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <title></title>
    <link rel="stylesheet" href="<?php echo asset('css/bootstro.css'); ?>">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo asset('js/bootstro.min.js');?>"></script>


</head>
<body>

<div class="container">
    <div class="col-md-10 col-sm-offset-1">

        <div class="jumbotron">
            <a id="demo" href="#" class="btn btn-large btn-success">Click me! I'm a Demo</a>
        </div>


        <?php

            $i = 0;

            $bootstro = ' data-bootstro-placement="top" data-bootstro-width="600px" class="bootstro"';

            echo '<div '.$bootstro.' data-bootstro-step="'.$i.'" data-bootstro-content="Le préambule" data-bootstro-title="">'.$content['preambule'].'</div>';

            $content['loi'] = array_filter($content['loi']);

            $i++;
            foreach( $content['loi'] as $contenu)
            {
                echo '<div '.$bootstro.' data-bootstro-step="'.$i.'" data-bootstro-content="Le contenu" data-bootstro-title="Loi">';
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

            echo '<div '.$bootstro.' data-bootstro-step="'.$i.'" data-bootstro-content="Le contenu" data-bootstro-title="Annexe">'.$content['annexe'].'</div>';$i++;
            echo '<div '.$bootstro.' data-bootstro-step="'.$i.'" data-bootstro-content="Le contenu" data-bootstro-title="RO">'.$content['RO'].'</div>';$i++;
            echo '<div '.$bootstro.' data-bootstro-step="'.$i.'" data-bootstro-content="Le contenu" data-bootstro-title="Notes">'.$content['notes'].'</div>';


/*            echo '<pre>';
            print_r($content['loi']);
            echo '</pre>';*/

        ?>
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