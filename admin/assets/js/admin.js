/**
 * Ecomolimpo Widgets Admin Scripts
 * 
 * @package Ecomolimpo_Widgets
 * @author Diego Cárdenas
 * @copyright 2025 Ecomolimpo
 */

(function($) {
    'use strict';

    class EcomolimpoAdmin {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            // Toggle widget
            $(document).on('change', '.widget-toggle-checkbox', this.toggleWidget.bind(this));
            
            // Clear cache
            $('#clear-cache-btn').on('click', this.clearCache.bind(this));
        }

        toggleWidget(e) {
            const $checkbox = $(e.currentTarget);
            const widgetId = $checkbox.data('widget');
            const status = $checkbox.is(':checked');
            const $card = $checkbox.closest('.ecomolimpo-widget-card');
            
            // Optimistic UI update
            if (status) {
                $card.addClass('active');
                $card.find('.status-badge').removeClass('inactive').addClass('active').text('Activo');
            } else {
                $card.removeClass('active');
                $card.find('.status-badge').removeClass('active').addClass('inactive').text('Inactivo');
            }

            $.ajax({
                url: ecomolimpoAdmin.ajaxurl,
                type: 'POST',
                data: {
                    action: 'ecomolimpo_toggle_widget',
                    nonce: ecomolimpoAdmin.nonce,
                    widget_id: widgetId,
                    status: status
                },
                success: (response) => {
                    if (response.success) {
                        this.showNotice(response.data.message, 'success');
                    } else {
                        this.showNotice(response.data || 'Error al cambiar el estado', 'error');
                        // Revert UI on error
                        $checkbox.prop('checked', !status);
                        if (!status) {
                            $card.addClass('active');
                            $card.find('.status-badge').removeClass('inactive').addClass('active').text('Activo');
                        } else {
                            $card.removeClass('active');
                            $card.find('.status-badge').removeClass('active').addClass('inactive').text('Inactivo');
                        }
                    }
                },
                error: () => {
                    this.showNotice('Error de conexión', 'error');
                    // Revert UI on error
                    $checkbox.prop('checked', !status);
                    if (!status) {
                        $card.addClass('active');
                        $card.find('.status-badge').removeClass('inactive').addClass('active').text('Activo');
                    } else {
                        $card.removeClass('active');
                        $card.find('.status-badge').removeClass('active').addClass('inactive').text('Inactivo');
                    }
                }
            });
        }

        clearCache(e) {
            e.preventDefault();
            
            const $btn = $(e.currentTarget);
            const originalText = $btn.html();
            
            $btn.addClass('loading').html('<span class="dashicons dashicons-update spin"></span> Limpiando...');

            $.ajax({
                url: ecomolimpoAdmin.ajaxurl,
                type: 'POST',
                data: {
                    action: 'ecomolimpo_clear_cache',
                    nonce: ecomolimpoAdmin.nonce
                },
                success: (response) => {
                    if (response.success) {
                        this.showNotice(response.data.message, 'success');
                    } else {
                        this.showNotice(response.data || 'Error al limpiar caché', 'error');
                    }
                },
                error: () => {
                    this.showNotice('Error de conexión', 'error');
                },
                complete: () => {
                    setTimeout(() => {
                        $btn.removeClass('loading').html(originalText);
                    }, 500);
                }
            });
        }

        showNotice(message, type) {
            const $notice = $('<div>', {
                class: `notice notice-${type} is-dismissible`,
                html: `<p>${message}</p>`
            });

            $('.ecomolimpo-admin-content').prepend($notice);

            // Auto dismiss after 3 seconds
            setTimeout(() => {
                $notice.fadeOut(() => $notice.remove());
            }, 3000);

            // Manual dismiss
            $notice.on('click', '.notice-dismiss', function() {
                $notice.fadeOut(() => $notice.remove());
            });
        }
    }

    // Initialize on document ready
    $(document).ready(function() {
        new EcomolimpoAdmin();
    });

    // CSS for spin animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin {
            animation: spin 1s linear infinite;
            display: inline-block;
        }
    `;
    document.head.appendChild(style);

})(jQuery);
