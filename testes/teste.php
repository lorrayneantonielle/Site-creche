<?php
echo $this->headLink()
        ->prependStylesheet($this->basePath() . '/css/app/cadastro_procedimentos.css')
        ->prependStylesheet($this->basePath() . '/css/app/tabs_procedimentos.css')

;
$this->id_procedimento;
?>

<style>
    #signatureparent{
        color:darkblue;
        background-color:darkgrey;
        /*max-width:600px;*/
        padding:20px;
    }

    /*This is the div within which the signature canvas is fitted*/
    #signature {
        border: 2px dotted black;
        background-color:lightgrey;
    }



    /* Drawing the 'gripper' for touch-enabled devices */
    html.touch #content {
        float:left;
        width:92%;
    }
    html.touch #scrollgrabber {
        float:right;
        width:4%;
        margin-right:2%;
        background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
    }
    html.borderradius #scrollgrabber {
        border-radius: 1em;
    }


</style>

<script type="text/javascript">
    $(window).on('load',function(){
    $('#ModalAssinaturaFisio').modal('show');
    $("body").resize();});

</script>



<div id="ModalAssinatura" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 80% !important;height: 400px !important;width:100% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assinatura do fisioterapeuta</h4>
            </div>
            <div class="modal-body">
                <div>
                    <div id="content">
                        <div id="signatureparent">
                            <div>Solicite ao fisioterapeuta que assine para que apareça a assinatura no PDF do procedimento:</div>
                            <div id="signature"></div></div>
                        <div id="tools" style="text-align: center;padding: 10px;margin-bottom: 10px !important;"></div>
                        <div id="exibicao_assinatura_fisio" style="display: none">
                            <br>
                            <p>Assinatura gerada:</p>
                            <br><div id="displayarea"></div>
                        </div>
                    </div>
                    <div id="scrollgrabber"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="salvar_assinatura_fisio" style="display: none;"><i class="fa fa-save"></i> Salvar Assinatura</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>

<script>
    /*  @preserve
    jQuery pub/sub plugin by Peter Higgins (dante@dojotoolkit.org)
    Loosely based on Dojo publish/subscribe API, limited in scope. Rewritten blindly.
    Original is (c) Dojo Foundation 2004-2010. Released under either AFL or new BSD, see:
    http://dojofoundation.org/license for more information.
    */
    (function($) {
        var topics = {};
        $.publish = function(topic, args) {
            if (topics[topic]) {
                var currentTopic = topics[topic],
                    args = args || {};

                for (var i = 0, j = currentTopic.length; i < j; i++) {
                    currentTopic[i].call($, args);
                }
            }
        };
        $.subscribe = function(topic, callback) {
            if (!topics[topic]) {
                topics[topic] = [];
            }
            topics[topic].push(callback);
            return {
                "topic": topic,
                "callback": callback
            };
        };
        $.unsubscribe = function(handle) {
            var topic = handle.topic;
            if (topics[topic]) {
                var currentTopic = topics[topic];

                for (var i = 0, j = currentTopic.length; i < j; i++) {
                    if (currentTopic[i] === handle.callback) {
                        currentTopic.splice(i, 1);
                    }
                }
            }
        };
    })(jQuery);

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="/js/plugins/jSignature/src/jSignature.js"></script>
<script src="/js/plugins/jSignature/src/plugins/jSignature.CompressorBase30.js"></script>
<script src="/js/plugins/jSignature/src/plugins/jSignature.CompressorSVG.js"></script>
<script src="/js/plugins/jSignature/src/plugins/jSignature.UndoButton.js"></script>
<script src="/js/plugins/jSignature/src/plugins/signhere/jSignature.SignHere.js"></script>

<script>

    $(document).ready(function() {
        $("#salvar_assinatura").click(function(){
            var assinatura = $("#assinatura_gerada").val();

            $.ajax({
                type: "POST",
                data: {
                    assinatura:assinatura
                },
                url: "/app/configuracao/salvarassinatura",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        alert(data);
                    }
                }
            });
        });
        // This is the part where jSignature is initialized.
        var $sigdiv = $("#signature").jSignature({'UndoButton':true})

            // All the code below is just code driving the demo.
            , $tools = $('#tools')
            , $extraarea = $('#displayarea')
            , pubsubprefix = 'jSignature.demo.'

        var export_plugins = $sigdiv.jSignature('listPlugins','export')
            , chops = ['<select style="display: none">']
            , name
        for(var i in export_plugins){
            if (export_plugins.hasOwnProperty(i)){
                name = export_plugins[i]
                //if(name == 'svg'){
                    chops.push('<option value="' + name + '">' + name + '</option>')
                //}
            }
        }
        chops.push('</select>')

        $(chops.join('')).bind('change', function(e){
            if (e.target.value !== ''){
                var data = $sigdiv.jSignature('getData', e.target.value)
                $.publish(pubsubprefix + 'formatchanged')
                if (typeof data === 'string'){
                    $('textarea', $tools).val(data)
                } else if($.isArray(data) && data.length === 2){
                    $('textarea', $tools).val(data.join(','))
                    $.publish(pubsubprefix + data[0], data);
                } else {
                    try {
                        $('textarea', $tools).val(JSON.stringify(data))
                    } catch (ex) {
                        $('textarea', $tools).val('Not sure how to stringify this, likely binary, format.')
                    }
                }
            }
        }).appendTo($tools)

        $('<input type="button" value="Gerar Assinatura" class="btn btn-primary" style="margin:0 auto !important;margin-right: 10px !important;">').bind('click', function(e){
            var data = $sigdiv.jSignature('getData', 'image');
            $.publish(pubsubprefix + 'formatchanged')
            if (typeof data === 'string'){
                $('textarea', $tools).val(data)
            } else if($.isArray(data) && data.length === 2){
                $('textarea', $tools).val(data.join(','))
                $.publish(pubsubprefix + data[0], data);
            } else {
                try {
                    $('textarea', $tools).val(JSON.stringify(data))
                } catch (ex) {
                    $('textarea', $tools).val('Not sure how to stringify this, likely binary, format.')
                }
            }
            $("#exibicao_assinatura").show();
            $("#salvar_assinatura").show();
        }).appendTo($tools);


        $('<input type="button" value="Limpar" class="btn btn-warning" style="margin:0 auto !important">').bind('click', function(e){
            $sigdiv.jSignature('reset')
        }).appendTo($tools)

        $('<div><textarea name="assinatura_gerada" id="assinatura_gerada" style="width:100%;height:7em;display: none;"></textarea></div>').appendTo($tools)

        $.subscribe(pubsubprefix + 'formatchanged', function(){
            $extraarea.html('')
        })

        $.subscribe(pubsubprefix + 'image/svg+xml', function(data) {

            try{
                var i = new Image()
                i.src = 'data:' + data[0] + ';base64,' + btoa( data[1] )
                $(i).appendTo($extraarea)
            } catch (ex) {

            }

            var message = [
                "Se você não vir uma imagem imediatamente acima, isso significa que seu navegador não pode exibir SVG in-line (formatado por URL de dados)."
                , "Isso NÃO é um problema com o jSignature, pois podemos exportar o documento SVG adequado, independentemente da capacidade do navegador de exibi-lo."
                , "Experimente esta página em um navegador moderno para ver o SVG na página ou exporte dados como SVG simples, salve em disco como arquivo de texto e visualize em qualquer visualizador com capacidade para SVG."
            ]
            $( "<div>" + message.join("<br/>") + "</div>" ).appendTo( $extraarea )
        });

        $.subscribe(pubsubprefix + 'image/svg+xml;base64', function(data) {
            var i = new Image()
            i.src = 'data:' + data[0] + ',' + data[1]
            $(i).appendTo($extraarea)

            var message = [
                "If you don't see an image immediately above, it means your browser is unable to display in-line (data-url-formatted) SVG."
                , "This is NOT an issue with jSignature, as we can export proper SVG document regardless of browser's ability to display it."
                , "Try this page in a modern browser to see the SVG on the page, or export data as plain SVG, save to disk as text file and view in any SVG-capabale viewer."
            ]
            $( "<div>" + message.join("<br/>") + "</div>" ).appendTo( $extraarea )
        });

        $.subscribe(pubsubprefix + 'image/png;base64', function(data) {
            var i = new Image()
            i.src = 'data:' + data[0] + ',' + data[1]
            $('<span><b>As you can see, one of the problems of "image" extraction (besides not working on some old Androids, elsewhere) is that it extracts A LOT OF DATA and includes all the decoration that is not part of the signature.</b></span>').appendTo($extraarea)
            $(i).appendTo($extraarea)
        });

        $.subscribe(pubsubprefix + 'image/jsignature;base30', function(data) {
            $('<span><b>This is a vector format not natively render-able by browsers. Format is a compressed "movement coordinates arrays" structure tuned for use server-side. The bonus of this format is its tiny storage footprint and ease of deriving rendering instructions in programmatic, iterative manner.</b></span>').appendTo($extraarea)
        });

        if (Modernizr.touch){
            $('#scrollgrabber').height($('#content').height());
            $('#scrollgrabber').resize();
        }

    })
</script> 
