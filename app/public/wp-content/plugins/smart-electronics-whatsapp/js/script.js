/**
 * Smart Electronics WhatsApp Chat - JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize WhatsApp button
        initWhatsAppButton();

        // Add pulse animation on scroll
        addPulseAnimation();

        // Auto-hide bubble after some time
        handleBubbleAutoHide();

        // Track clicks for analytics
        trackButtonClicks();
    });

    function initWhatsAppButton() {
        const $container = $('#smart-electronics-whatsapp-container');
        const $button = $('.sewhatsapp-button');

        // Apply custom colors if set
        if (typeof smartElectronicsWhatsApp !== 'undefined') {
            // Colors can be applied via inline styles in PHP
            // This is just a placeholder for future enhancements
        }

        // Add loading state on click
        $button.on('click', function() {
            $(this).addClass('loading');
        });

        // Initialize animation
        setTimeout(function() {
            $button.addClass('pulse');
        }, 2000);
    }

    function addPulseAnimation() {
        let lastScrollTop = 0;
        const $button = $('.sewhatsapp-button');

        $(window).scroll(function() {
            const scrollTop = $(this).scrollTop();

            // Add attention pulse when scrolling significantly
            if (Math.abs(scrollTop - lastScrollTop) > 300) {
                $button.removeClass('pulse');
                setTimeout(function() {
                    $button.addClass('pulse');
                }, 100);
            }

            lastScrollTop = scrollTop;
        });
    }

    function handleBubbleAutoHide() {
        const $bubble = $('.sewhatsapp-bubble');

        if ($bubble.length > 0) {
            // Auto-hide bubble after 10 seconds
            setTimeout(function() {
                $bubble.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 10000);

            // Hide on click
            $bubble.on('click', function() {
                $(this).fadeOut(300);
            });
        }
    }

    function trackButtonClicks() {
        $('.sewhatsapp-button').on('click', function() {
            // Track Google Analytics event if available
            if (typeof ga !== 'undefined') {
                ga('send', 'event', 'WhatsApp', 'click', 'WhatsApp Chat Button');
            }

            // Track Google Analytics 4 event if available
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'WhatsApp',
                    'event_label': 'WhatsApp Chat Button'
                });
            }

            // Track Facebook Pixel event if available
            if (typeof fbq !== 'undefined') {
                fbq('trackCustom', 'WhatsAppChatClick');
            }

            console.log('WhatsApp button clicked');
        });
    }

    // Dynamic message based on page context
    function getDynamicMessage() {
        let message = smartElectronicsWhatsApp.defaultMessage;

        // Add product info if on product page
        if ($('body').hasClass('single-product')) {
            const productName = $('.product_title').text();
            if (productName) {
                message += ' - ' + productName;
            }
        }

        // Add cart info if items in cart
        if (typeof wc_add_to_cart_params !== 'undefined') {
            const cartCount = wc_add_to_cart_params.cart_count;
            if (cartCount > 0) {
                message += ' (Cart: ' + cartCount + ' items)';
            }
        }

        return message;
    }

    // Show button after delay (optional)
    function showButtonAfterDelay() {
        const $container = $('#smart-electronics-whatsapp-container');
        $container.hide();

        setTimeout(function() {
            $container.fadeIn(500);
        }, 3000);
    }

    // A/B testing for button text
    function testButtonText() {
        const texts = [
            'Chat with us',
            'Need help?',
            'Talk to us',
            'WhatsApp Support'
        ];

        const randomText = texts[Math.floor(Math.random() * texts.length)];
        $('.sewhatsapp-button-text').text(randomText);
    }

})(jQuery);

// Export for potential use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SmartElectronicsWhatsApp;
}