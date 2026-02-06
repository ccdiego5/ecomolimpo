jQuery(document).ready(function($) {
    
    // Usamos delegación de eventos para asegurar que funcione incluso si el DOM cambia
    // o si Elementor reinicializa el widget.
    $(document).on('click', '.ecomolimpo-faq-header', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $header = $(this);
        var $item = $header.closest('.ecomolimpo-faq-item');
        var $content = $item.find('.ecomolimpo-faq-content');
        
        // Alternar clase activa
        $item.toggleClass('active');
        
        if ($item.hasClass('active')) {
            // scrollHeight obtiene la altura real del contenido aunque esté oculto
            var scrollHeight = $content.prop('scrollHeight');
            $content.css('max-height', scrollHeight + 'px');
            $content.css('opacity', '1');
        } else {
            $content.css('max-height', '0');
            $content.css('opacity', '0');
        }
    });

    // Ajustar altura al redimensionar ventana (opcional, para responsividad)
    $(window).on('resize', function() {
        $('.ecomolimpo-faq-item.active .ecomolimpo-faq-content').each(function() {
            var $content = $(this);
            $content.css('max-height', $content.prop('scrollHeight') + 'px');
        });
    });

});
