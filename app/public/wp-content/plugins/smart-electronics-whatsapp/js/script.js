/**
 * Smart Electronics WhatsApp Chat - JavaScript
 */

(function($) {
    "use strict";

    $(document).ready(function() {
        initWhatsAppButton();
        handleBubbleAutoHide();
        trackButtonClicks();
    });

    function initWhatsAppButton() {
        var $container = $("#smart-electronics-whatsapp-container");
        var $button = $(".sewhatsapp-button");

        if ($container.length === 0) {
            console.log("WhatsApp container not found");
            return;
        }

        console.log("WhatsApp button initialized");

        // Add pulse animation after delay
        setTimeout(function() {
            $button.addClass("pulse");
        }, 2000);

        // Loading state on click
        $button.on("click", function() {
            $(this).addClass("loading");
        });
    }

    function handleBubbleAutoHide() {
        var $bubble = $(".sewhatsapp-bubble");

        if ($bubble.length > 0) {
            // Auto-hide after 10 seconds
            setTimeout(function() {
                $bubble.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 10000);

            // Hide on click
            $bubble.on("click", function() {
                $(this).fadeOut(300);
            });
        }
    }

    function trackButtonClicks() {
        $(".sewhatsapp-button").on("click", function() {
            // Google Analytics
            if (typeof gtag !== "undefined") {
                gtag("event", "click", {
                    event_category: "WhatsApp",
                    event_label: "WhatsApp Chat Button"
                });
            }

            // Facebook Pixel
            if (typeof fbq !== "undefined") {
                fbq("trackCustom", "WhatsAppChatClick");
            }

            console.log("WhatsApp button clicked");
        });
    }

})(jQuery);
