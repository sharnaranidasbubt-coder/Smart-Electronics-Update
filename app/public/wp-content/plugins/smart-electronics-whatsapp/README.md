# Smart Electronics WhatsApp Chat Plugin

A custom WordPress plugin for Smart Electronics that adds a professional WhatsApp chat button to your WooCommerce store.

## Features

- ✅ **Floating WhatsApp Button** - Eye-catching chat button
- ✅ **WooCommerce Integration** - Product-specific messages
- ✅ **Customizable Design** - Colors, position, text
- ✅ **Analytics Ready** - Google Analytics & Facebook Pixel tracking
- ✅ **Mobile Responsive** - Perfect on all devices
- ✅ **Easy Configuration** - Simple admin settings panel
- ✅ **Smart Display Rules** - Show on specific pages
- ✅ **Greeting Bubble** - Welcome message animation
- ✅ **Performance Optimized** - Minimal impact on page speed

## Installation

1. Upload the `smart-electronics-whatsapp` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure settings under **Settings → Smart Electronics WhatsApp**

## Configuration

### Basic Setup

1. **WhatsApp Phone Number**: Enter your business number (e.g., `1234567890`)
2. **Default Message**: Set the pre-filled message (e.g., `Hi! I need help with my order.`)
3. **Button Text**: Customize button text (e.g., `Chat with us`)

### Advanced Options

- **Button Position**: Choose bottom-right or bottom-left
- **Display Rules**: Show/hide on product pages and home page
- **Greeting Bubble**: Enable/disable welcome message
- **Custom Colors**: Match your brand colors

## Usage Tips

### For Smart Electronics Store

1. **Product Pages**: Automatically includes product name in message
2. **Cart Integration**: Shows cart item count in message
3. **Business Hours**: Consider setting different messages for different times
4. **Multi-language**: Works with WPML and Polylang

### Analytics Integration

The plugin automatically tracks:
- Google Analytics events (if GA is installed)
- Google Analytics 4 events (if gtag is available)
- Facebook Pixel custom events (if FB Pixel is installed)

## Customization

### CSS Customization

Edit `css/style.css` to customize:
- Button size and shape
- Animation effects
- Color schemes
- Responsive breakpoints

### JavaScript Enhancement

Edit `js/script.js` to add:
- Custom behavior
- Additional analytics
- Dynamic messaging
- A/B testing

## Troubleshooting

### Button Not Showing

1. Check if phone number is configured
2. Verify display rules are correct
3. Clear browser cache
4. Check for JavaScript errors in console

### WhatsApp Link Not Working

1. Ensure phone number format is correct (no spaces or dashes)
2. Test with `https://wa.me/YOUR_NUMBER`
3. Check if WhatsApp is installed on device

## Support

For issues or questions, contact the development team.

## Changelog

### 1.0.0
- Initial release
- Basic WhatsApp button functionality
- WooCommerce integration
- Admin settings panel
- Analytics tracking
- Responsive design

## License

GPL v2 or later