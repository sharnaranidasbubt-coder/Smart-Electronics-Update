<?php
/**
 * Template Name: About Us Page - Demo Clone
 * Description: Complete About Us page cloned from about-us-demo.html
 */

get_header();
?>

<style>
    /* Fallback: Ensure Font Awesome icons are visible if CDN fails to load */
    .stat-icon i::before,
    .mission-icon i::before,
    .feature-icon-wrapper i::before,
    .about-features li i::before {
        display: block !important;
        font-family: "Font Awesome 6 Free" !important;
        font-weight: 900 !important;
    }
</style>


<div class="about-us-page-wrapper">
    <?php while ( have_posts() ) : the_post(); ?>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">About Us</h1>
                <p class="hero-subtitle">Powering Your Smart Lifestyle</p>
                <div class="hero-line"></div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <div class="about-content animate-on-scroll">
                <span class="section-tag">Who We Are</span>
                <h2 class="about-title">Your Trusted Partner in Premium Smart Electronics</h2>
                <p class="about-text">
                    At Sony Smart, we are committed to delivering exceptional quality electronics and innovative smart solutions that transform the way you live and work. Our dedication to excellence ensures that every product we offer meets the highest standards of performance and reliability, while our customer-first approach guarantees a seamless shopping experience from start to finish.
                </p>
                <div class="about-divider"></div>
                <ul class="about-features">
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white" style="vertical-align: middle; margin-right: 8px;"><path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91c4.59-1.15 8-5.86 8-10.91V5l-8-3zm-1.06 13.54L7.4 12l1.41-1.41l2.12 2.12l4.24-4.24l1.41 1.41l-5.64 5.66z"/></svg> Premium Quality</li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white" style="vertical-align: middle; margin-right: 8px;"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94c.63 1.5 1.98 2.63 3.61 2.96V19H7v2h10v-2h-4v-3.1c1.63-.33 2.98-1.46 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg> 15+ Years Excellence</li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white" style="vertical-align: middle; margin-right: 8px;"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57c-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.58l2.2-2.21c.28-.27.36-.66.25-1.01C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1c0 9.39 7.61 17 17 17c.55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/></svg> Expert Support</li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white" style="vertical-align: middle; margin-right: 8px;"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg> 100% Genuine</li>
                </ul>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="stats-container">
                <div class="stats-grid">
                    <div class="stat-item animate-on-scroll">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M21 16.5c0 .38-.21.71-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18s-.41-.06-.57-.18l-7.9-4.44A.991.991 0 0 1 3 16.5v-9c0-.38.21-.71.53-.88l7.9-4.44c.16-.12.36-.18.57-.18s.41.06.57.18l7.9 4.44c.32.17.53.5.53.88v9zM12 4.15L5 8.09v7.82l7 3.94l7-3.94V8.09l-7-3.94z"/></svg>
                        </div>
                        <span class="stat-number" data-count="2000">2000+</span>
                        <span class="stat-label">Products</span>
                    </div>
                    <div class="stat-item animate-on-scroll">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93c0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41c0 2.08-.8 3.97-2.1 5.39z"/></svg>
                        </div>
                        <span class="stat-number" data-count="200">200+</span>
                        <span class="stat-label">Dealers</span>
                    </div>
                    <div class="stat-item animate-on-scroll">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2L9.19 8.63L2 9.24l5.46 4.73L5.82 21L12 17.27z"/></svg>
                        </div>
                        <span class="stat-number" data-count="50">50+</span>
                        <span class="stat-label">Brands</span>
                    </div>
                    <div class="stat-item animate-on-scroll">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05c1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                        </div>
                        <span class="stat-number" data-count="15000">15K+</span>
                        <span class="stat-label">Customers</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="section-header animate-on-scroll">
                <h2 class="section-title">Why Choose Us</h2>
                <p class="section-description">Discover the advantages that make Sony Smart the preferred choice for smart electronics</p>
            </div>
            <div class="features-grid">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M6 2h12v2H6V2zm0 4h12v12H6V6zm2 2v8h8V8H8zm-6 2h2v6H2v-6zm18 0h2v6h-2v-6z"/></svg>
                    </div>
                    <h3>Latest Technology</h3>
                    <p>Stay ahead with the newest products and innovations from leading brands worldwide.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>
                    <h3>100% Reliable</h3>
                    <p>All products are genuine and come with manufacturer warranty for peace of mind.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5s-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/></svg>
                    </div>
                    <h3>Fast Delivery</h3>
                    <p>Quick and secure delivery to your doorstep with real-time order tracking.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57c-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.58l2.2-2.21c.28-.27.36-.66.25-1.01C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1c0 9.39 7.61 17 17 17c.55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/></svg>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated support team is available round the clock to assist you.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15c0-1.09 1.01-1.85 2.7-1.85c1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61c0 2.31 1.91 3.46 4.7 4.13c2.5.6 3 1.48 3 2.41c0 .69-.49 1.79-2.7 1.79c-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55c0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                    </div>
                    <h3>Best Price</h3>
                    <p>Competitive pricing with regular promotions and price match guarantee.</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M12.5 8c-2.65 0-5.05.99-6.9 2.6L2 7v9h9l-3.62-3.62c1.39-1.16 3.16-1.88 5.12-1.88c3.54 0 6.55 2.31 7.6 5.5l2.37-.78C21.08 11.03 17.15 8 12.5 8z"/></svg>
                    </div>
                    <h3>Easy Returns</h3>
                    <p>Hassle-free return policy with customer satisfaction as our top priority.</p>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="mission-section">
            <div class="mission-container">
                <div class="section-header animate-on-scroll">
                    <h2 class="section-title" style="color: white;">Our Foundation</h2>
                    <p class="section-description" style="color: rgba(255,255,255,0.8);">The values that drive everything we do</p>
                </div>
                <div class="mission-grid">
                    <div class="mission-card animate-on-scroll">
                        <div class="mission-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        </div>
                        <h3>Our Mission</h3>
                        <p>To provide cutting-edge electronics and smart solutions that enhance everyday life, making technology accessible and affordable for everyone.</p>
                    </div>
                    <div class="mission-card animate-on-scroll">
                        <div class="mission-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3z"/></svg>
                        </div>
                        <h3>Our Vision</h3>
                        <p>To be the most trusted electronics retailer, known for excellence, innovation, and customer-centric service in the smart technology market.</p>
                    </div>
                    <div class="mission-card animate-on-scroll">
                        <div class="mission-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <h3>Our Values</h3>
                        <p>Integrity, quality, innovation, and customer satisfaction drive everything we do. Building lasting relationships through trust and excellence.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content animate-on-scroll">
                <h2 class="cta-title">Ready to Experience the Sony Smart Difference?</h2>
                <p class="cta-text">Join thousands of satisfied customers and discover premium electronics with exceptional service.</p>
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn-white">Shop Now</a>
            </div>
        </section>

    <?php endwhile; ?>
</div>

<script>
// Scroll Animation
function animateOnScroll() {
    const elements = document.querySelectorAll('.animate-on-scroll');

    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;

        if (elementTop < window.innerHeight - elementVisible) {
            element.classList.add('animated');
        }
    });
}

window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);

// Counter Animation
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                if (target >= 1000) {
                    counter.textContent = Math.floor(current / 1000) + 'K+';
                } else {
                    counter.textContent = Math.floor(current) + '+';
                }
                requestAnimationFrame(updateCounter);
            } else {
                if (target >= 1000) {
                    counter.textContent = (target / 1000) + 'K+';
                } else {
                    counter.textContent = target + '+';
                }
            }
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(counter);
    });
}

animateCounters();
</script>

<?php get_footer(); ?>
