/*  * OLInputCount - 1.0.1
    * PLUGIN EM JQUERY.
    * Cria um contador de caracterers para um input ou uma textarea
    * @AUTHOR 2001-2019 ORLANDO LIBARDI - orlando.libardi@gmail.com - orlandolibardi.com.br
    * Usage : $("input[name=]").OLInputCount({ 'max' : 90, 'inside' : '#label_meta_title'});
    * */
(function($) {
	"use strict";
	$.fn.OLInputCount = function(options, callback) {
		var $el = $(this);
		var $document = $(document);
	    var id = Math.floor((Math.random() * 100) + 1);
        var defaults = {
            'min' : '00',
            'max': false,
            'greenCollor' : '#1ab394',
            'redCollor' : '#ed5565',
            'inside' : false,
        };
        /**
         * SETTINGS - 
         */
		var settings = $.extend({}, defaults, options);
        /**
         * Init
         * @return show()
         */
		function init() {
            $el.attr("maxlength", settings.max)
               .attr("data-countable", id);
            if(settings.inside === false){
                $el.after( show() );   
            }else{
                $(settings.inside).append( show() );
            }
        }       
        /**
         * Retorna o modelo de contagem com os valores iniciais
         * @return string
         */
        function show(){
            return '<div id="count-'+id+'" style="display:inline-block; float:right;">' + 
                   '<span id="total-'+id+'">'+settings.min+'</span> / <span id="max-'+id+'">'+settings.max+'</span>' +
                   '</div>';
        }
        /**
        * Atualiza a contagem
        * @param int id
        * @param string value
        * @return 
        */
        function update(id, value){
            var i = parseInt(value.length);    
            if(i > settings.max) return false; 
            var min = ( i < 10 ) ? '0' + i : i;
            var collor = ( i < settings.max ) ? settings.greenCollor : settings.redCollor;            
            $('#total-'+id).css('color', collor).html(min);
        }   
        /**
         * EVENTOS
         * keypress, focusout 
        */
		$(document).on("keypress", "*[data-countable]", function(){
            update($(this).attr('data-countable'), $(this).val());
        });
        $(document).on("focusout", "*[data-countable]", function(){
            update($(this).attr('data-countable'), $(this).val());
        });
        /**
         * Ready 
         * Verifica se existem valores no campo caso positivo atualiza os valores de contagem
         */
        $document.ready(function(){
            update($el.attr('data-countable'), $el.val());
        });
        /**
         * Return init
         */
		init();
	}
}(jQuery));
