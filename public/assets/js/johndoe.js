/*!
=========================================================
* JohnDoe Landing page
=========================================================

* Copyright: 2019 DevCRUD (https://devcrud.com)
* Licensed: (https://devcrud.com/licenses)
* Coded by www.devcrud.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*/

// smooth scroll
$(document).ready(function(){
    $(".navbar .nav-link").on('click', function(event) {

        if (this.hash !== "") {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 700, function(){
                window.location.hash = hash;
            });
        } 
    });
});

// Portfolio filter
$(document).ready(function () {
    // Filter click
    $(document).on('click', '.filter-link', function (e) {
        e.preventDefault();

        const $this = $(this);
        const categoryId = $this.data('category-id');
        const portfolioId = $this.data('portfolio-id');

        // Set active class
        $('.filters[data-portfolio-id="' + portfolioId + '"] .filter-link').removeClass('active');
        $this.addClass('active');

        // Load filtered projects
        loadProjects(portfolioId, categoryId, 1);
    });

    // Pagination click
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();

        const pageUrl = $(this).attr('href');
        const urlParams = new URLSearchParams(pageUrl.split('?')[1]);

        const container = $(this).closest('.portfolio-container');
        const portfolioId = container.attr('id').replace('portfolio-container-', '');
        const categoryId = $('.filters[data-portfolio-id="' + portfolioId + '"] .filter-link.active').data('category-id');

        // Support custom page parameter (e.g., page_2)
        const page = urlParams.get('page') || urlParams.get('page_' + portfolioId) || 1;

        loadProjects(portfolioId, categoryId, page);
    });

    // AJAX load projects
    function loadProjects(portfolioId, categoryId, page = 1) {
        const container = $('#portfolio-container-' + portfolioId);

        $.ajax({
            url: window.ajaxRoutes.filterProjects,
            method: "GET",
            data: {
                portfolio_id: portfolioId,
                category_id: categoryId,
                page: page
            },
            headers: {
                'X-CSRF-TOKEN': window.ajaxRoutes.csrfToken
            },
            success: function (data) {
                container.html(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
                container.html('<p class="text-danger">Could not load projects. Try again later.</p>');
            }
        });
    }
});

// Icon categories with multiple icon libraries
const iconCategories = {
  business: [
      // Font Awesome Business
      'fas fa-briefcase', 'fas fa-chart-line', 'fas fa-handshake', 'fas fa-building',
      'fas fa-chart-bar', 'fas fa-chart-pie', 'fas fa-chart-area', 'fas fa-calculator',
      'fas fa-wallet', 'fas fa-receipt', 'fas fa-file-invoice', 'fas fa-file-contract',
      'fas fa-file-signature', 'fas fa-stamp', 'fas fa-percentage', 'fas fa-business-time',
      'fas fa-city', 'fas fa-industry', 'fas fa-factory', 'fas fa-store',
      'fas fa-store-alt', 'fas fa-shop', 'fas fa-cash-register', 'fas fa-credit-card',
      
      // Material Design Icons Business
      'mdi mdi-briefcase', 'mdi mdi-chart-line', 'mdi mdi-handshake', 'mdi mdi-office-building',
      'mdi mdi-chart-bar', 'mdi mdi-chart-pie', 'mdi mdi-chart-areaspline', 'mdi mdi-calculator',
      'mdi mdi-wallet', 'mdi mdi-receipt', 'mdi mdi-file-document', 'mdi mdi-file-contract',
      'mdi mdi-signature', 'mdi mdi-stamp', 'mdi mdi-percent', 'mdi mdi-business',
      
      // Unicons Business
      'uil uil-briefcase', 'uil uil-chart-line', 'uil uil-handshake', 'uil uil-building',
      'uil uil-chart-bar', 'uil uil-chart', 'uil uil-calculator', 'uil uil-wallet',
      'uil uil-receipt', 'uil uil-file-contract', 'uil uil-signature', 'uil uil-percentage'
  ],

  communication: [
      // Font Awesome Communication
      'fas fa-envelope', 'fas fa-phone', 'fas fa-comment', 'fas fa-comments',
      'fas fa-video', 'fas fa-microphone', 'fas fa-broadcast-tower', 'fas fa-wifi',
      'fas fa-paper-plane', 'fas fa-inbox', 'fas fa-mail-bulk', 'fas fa-at',
      'fas fa-bell', 'fas fa-rss', 'fas fa-share', 'fas fa-share-alt',
      'fas fa-comment-dots', 'fas fa-comment-alt', 'fas fa-phone-alt', 'fas fa-phone-square',
      'fas fa-phone-volume', 'fas fa-fax', 'fas fa-pager', 'fas fa-mobile-alt',
      
      // Material Design Icons Communication
      'mdi mdi-email', 'mdi mdi-phone', 'mdi mdi-comment', 'mdi mdi-comment-multiple',
      'mdi mdi-video', 'mdi mdi-microphone', 'mdi mdi-antenna', 'mdi mdi-wifi',
      'mdi mdi-send', 'mdi mdi-inbox', 'mdi mdi-email-multiple', 'mdi mdi-at',
      'mdi mdi-bell', 'mdi mdi-rss', 'mdi mdi-share', 'mdi mdi-share-variant',
      
      // Unicons Communication
      'uil uil-envelope', 'uil uil-phone', 'uil uil-comment', 'uil uil-comments',
      'uil uil-video', 'uil uil-microphone', 'uil uil-wifi', 'uil uil-paperclip',
      'uil uil-inbox', 'uil uil-at', 'uil uil-bell', 'uil uil-rss', 'uil uil-share'
  ],

  design: [
      // Font Awesome Design
      'fas fa-paint-brush', 'fas fa-palette', 'fas fa-pencil-ruler', 'fas fa-magic',
      'fas fa-crop', 'fas fa-fill', 'fas fa-fill-drip', 'fas fa-vector-square',
      'fas fa-pen', 'fas fa-pen-fancy', 'fas fa-pen-nib', 'fas fa-pencil-alt',
      'fas fa-spray-can', 'fas fa-swatchbook', 'fas fa-layer-group', 'fas fa-drafting-compass',
      'fas fa-brush', 'fas fa-paint-roller', 'fas fa-eye-dropper', 'fas fa-stamp',
      'fas fa-shapes', 'fas fa-crop-alt', 'fas fa-ruler-combined', 'fas fa-ruler',
      
      // Material Design Icons Design
      'mdi mdi-brush', 'mdi mdi-palette', 'mdi mdi-ruler', 'mdi mdi-magic',
      'mdi mdi-crop', 'mdi mdi-format-paint', 'mdi mdi-vector-square', 'mdi mdi-pen',
      'mdi mdi-fountain-pen', 'mdi mdi-pencil', 'mdi mdi-spray', 'mdi mdi-palette-swatch',
      'mdi mdi-layers', 'mdi mdi-compass', 'mdi mdi-brush-variant', 'mdi mdi-ruler-square',
      
      // Unicons Design
      'uil uil-brush-alt', 'uil uil-palette', 'uil uil-ruler', 'uil uil-magic-wand',
      'uil uil-crop-alt', 'uil uil-brush', 'uil uil-vector-square', 'uil uil-pen',
      'uil uil-pencil', 'uil uil-layer-group', 'uil uil-compass'
  ],

  development: [
      // Font Awesome Development
      'fas fa-code', 'fas fa-terminal', 'fas fa-bug', 'fas fa-code-branch',
      'fas fa-database', 'fas fa-laptop-code', 'fas fa-microchip', 'fas fa-server',
      'fas fa-project-diagram', 'fas fa-sitemap', 'fas fa-stream', 'fas fa-network-wired',
      'fas fa-file-code', 'fas fa-keyboard', 'fas fa-usb', 'fas fa-memory',
      'fas fa-hdd', 'fas fa-desktop', 'fas fa-laptop', 'fas fa-mobile',
      'fas fa-tablet', 'fas fa-cog', 'fas fa-cogs', 'fas fa-wrench',
      
      // Material Design Icons Development
      'mdi mdi-code', 'mdi mdi-console', 'mdi mdi-bug', 'mdi mdi-source-branch',
      'mdi mdi-database', 'mdi mdi-laptop', 'mdi mdi-chip', 'mdi mdi-server',
      'mdi mdi-sitemap', 'mdi mdi-lan', 'mdi mdi-keyboard', 'mdi mdi-usb',
      'mdi mdi-memory', 'mdi mdi-harddisk', 'mdi mdi-desktop-tower', 'mdi mdi-wrench',
      
      // Unicons Development
      'uil uil-brackets-curly', 'uil uil-terminal', 'uil uil-bug', 'uil uil-code-branch',
      'uil uil-database', 'uil uil-laptop', 'uil uil-server', 'uil uil-keyboard',
      'uil uil-desktop', 'uil uil-wrench'
  ],

  brands: [
      'fab fa-facebook', 'fab fa-twitter', 'fab fa-instagram', 'fab fa-linkedin',
      'fab fa-youtube', 'fab fa-pinterest', 'fab fa-snapchat', 'fab fa-tiktok',
      'fab fa-whatsapp', 'fab fa-telegram', 'fab fa-discord', 'fab fa-slack',
      'fab fa-github', 'fab fa-gitlab', 'fab fa-bitbucket', 'fab fa-jira',
      'fab fa-trello', 'fab fa-asana', 'fab fa-confluence', 'fab fa-wordpress',
      'fab fa-drupal', 'fab fa-joomla', 'fab fa-magento', 'fab fa-shopify',
      'fab fa-wix', 'fab fa-squarespace', 'fab fa-webflow', 'fab fa-hubspot',
      'fab fa-mailchimp', 'fab fa-constant-contact', 'fab fa-salesforce', 'fab fa-stripe',
      'fab fa-paypal', 'fab fa-square', 'fab fa-amazon-pay', 'fab fa-apple-pay',
      'fab fa-google-pay', 'fab fa-cc-visa', 'fab fa-cc-mastercard', 'fab fa-cc-amex',
      'fab fa-bitcoin', 'fab fa-ethereum', 'fab fa-dogecoin', 'fab fa-litecoin',
      'fab fa-aws', 'fab fa-google-cloud', 'fab fa-azure', 'fab fa-digital-ocean',
      'fab fa-android', 'fab fa-apple', 'fab fa-windows', 'fab fa-linux',
      'fab fa-ubuntu', 'fab fa-centos', 'fab fa-fedora', 'fab fa-redhat',
      'fab fa-chrome', 'fab fa-firefox', 'fab fa-safari', 'fab fa-edge',
      'fab fa-opera', 'fab fa-internet-explorer', 'fab fa-brave', 'fab fa-tor',
      'fab fa-angular', 'fab fa-react', 'fab fa-vuejs', 'fab fa-node',
      'fab fa-npm', 'fab fa-yarn', 'fab fa-composer', 'fab fa-gradle'
  ],

  finance: [
      // Font Awesome Finance
      'fas fa-dollar-sign', 'fas fa-euro-sign', 'fas fa-pound-sign', 'fas fa-yen-sign',
      'fas fa-ruble-sign', 'fas fa-rupee-sign', 'fas fa-won-sign', 'fas fa-shekel-sign',
      'fas fa-money-bill', 'fas fa-money-bill-wave', 'fas fa-money-bill-alt', 'fas fa-coins',
      'fas fa-cash-register', 'fas fa-credit-card', 'fas fa-receipt', 'fas fa-percentage',
      'fas fa-piggy-bank', 'fas fa-wallet', 'fas fa-bank', 'fas fa-landmark',
      'fas fa-chart-line', 'fas fa-chart-bar', 'fas fa-chart-pie', 'fas fa-chart-area',
      
      // Material Design Icons Finance
      'mdi mdi-currency-usd', 'mdi mdi-currency-eur', 'mdi mdi-currency-gbp', 'mdi mdi-currency-jpy',
      'mdi mdi-currency-rub', 'mdi mdi-currency-inr', 'mdi mdi-currency-krw', 'mdi mdi-currency-ils',
      'mdi mdi-cash', 'mdi mdi-cash-multiple', 'mdi mdi-credit-card', 'mdi mdi-receipt',
      'mdi mdi-piggy-bank', 'mdi mdi-wallet', 'mdi mdi-bank', 'mdi mdi-chart-line',
      
      // Unicons Finance
      'uil uil-dollar-sign', 'uil uil-euro', 'uil uil-pound', 'uil uil-yen',
      'uil uil-money-bill', 'uil uil-credit-card', 'uil uil-receipt', 'uil uil-percentage',
      'uil uil-money-withdraw', 'uil uil-chart-line', 'uil uil-chart', 'uil uil-chart-pie'
  ],

  weather: [
      // Font Awesome Weather
      'fas fa-sun', 'fas fa-moon', 'fas fa-cloud', 'fas fa-cloud-rain',
      'fas fa-cloud-showers-heavy', 'fas fa-cloud-sun', 'fas fa-cloud-moon',
      'fas fa-wind', 'fas fa-snowflake', 'fas fa-umbrella', 'fas fa-bolt',
      'fas fa-temperature-high', 'fas fa-temperature-low', 'fas fa-rainbow',
      
      // Material Design Icons Weather
      'mdi mdi-weather-sunny', 'mdi mdi-weather-night', 'mdi mdi-weather-cloudy',
      'mdi mdi-weather-rainy', 'mdi mdi-weather-pouring', 'mdi mdi-weather-partly-cloudy',
      'mdi mdi-weather-windy', 'mdi mdi-snowflake', 'mdi mdi-umbrella', 'mdi mdi-lightning-bolt',
      'mdi mdi-thermometer', 'mdi mdi-rainbow', 'mdi mdi-weather-snowy', 'mdi mdi-weather-fog',
      
      // Unicons Weather
      'uil uil-sun', 'uil uil-moon', 'uil uil-cloud', 'uil uil-cloud-rain',
      'uil uil-cloud-showers-heavy', 'uil uil-wind', 'uil uil-snowflake',
      'uil uil-umbrella', 'uil uil-temperature', 'uil uil-rainbow'
  ],

  medical: [
      // Font Awesome Medical
      'fas fa-hospital', 'fas fa-ambulance', 'fas fa-user-md', 'fas fa-stethoscope',
      'fas fa-pills', 'fas fa-prescription', 'fas fa-prescription-bottle',
      'fas fa-microscope', 'fas fa-dna', 'fas fa-brain', 'fas fa-heart',
      'fas fa-lungs', 'fas fa-bone', 'fas fa-teeth', 'fas fa-virus', 'fas fa-bacteria',
      
      // Material Design Icons Medical
      'mdi mdi-hospital', 'mdi mdi-ambulance', 'mdi mdi-doctor', 'mdi mdi-stethoscope',
      'mdi mdi-pill', 'mdi mdi-microscope', 'mdi mdi-dna', 'mdi mdi-brain',
      'mdi mdi-heart', 'mdi mdi-lungs', 'mdi mdi-bone', 'mdi mdi-virus',
      
      // Unicons Medical
      'uil uil-hospital', 'uil uil-ambulance', 'uil uil-medical-square', 'uil uil-medical',
      'uil uil-heart-medical', 'uil uil-microscope', 'uil uil-virus', 'uil uil-syringe'
  ],

  education: [
      // Font Awesome Education
      'fas fa-graduation-cap', 'fas fa-book', 'fas fa-school', 'fas fa-university',
      'fas fa-chalkboard', 'fas fa-chalkboard-teacher', 'fas fa-apple-alt',
      'fas fa-pencil-alt', 'fas fa-pen', 'fas fa-marker', 'fas fa-highlighter',
      'fas fa-book-open', 'fas fa-book-reader', 'fas fa-bookmark', 'fas fa-award',
      
      // Material Design Icons Education
      'mdi mdi-school', 'mdi mdi-book', 'mdi mdi-library', 'mdi mdi-teach',
      'mdi mdi-pencil', 'mdi mdi-notebook', 'mdi mdi-bookshelf', 'mdi mdi-certificate',
      'mdi mdi-school-outline', 'mdi mdi-book-open-page-variant', 'mdi mdi-pencil-box',
      
      // Unicons Education
      'uil uil-graduation-cap', 'uil uil-book-alt', 'uil uil-school', 'uil uil-university',
      'uil uil-book', 'uil uil-pencil', 'uil uil-award', 'uil uil-certificate'
  ],

  food: [
      // Font Awesome Food
      'fas fa-utensils', 'fas fa-hamburger', 'fas fa-pizza-slice', 'fas fa-ice-cream',
      'fas fa-cookie', 'fas fa-candy-cane', 'fas fa-apple-alt', 'fas fa-carrot',
      'fas fa-wine-glass', 'fas fa-coffee', 'fas fa-beer', 'fas fa-cocktail',
      'fas fa-cheese', 'fas fa-egg', 'fas fa-bread-slice', 'fas fa-drumstick-bite',
      
      // Material Design Icons Food
      'mdi mdi-food', 'mdi mdi-food-fork-drink', 'mdi mdi-pizza', 'mdi mdi-ice-cream',
      'mdi mdi-cookie', 'mdi mdi-fruit-cherries', 'mdi mdi-coffee', 'mdi mdi-beer',
      'mdi mdi-glass-wine', 'mdi mdi-hamburger', 'mdi mdi-noodles',
      
      // Unicons Food
      'uil uil-restaurant', 'uil uil-pizza-slice', 'uil uil-coffee', 'uil uil-glass-martini',
      'uil uil-food', 'uil uil-utensils', 'uil uil-wine-glass', 'uil uil-burger'
  ],

  sports: [
      // Font Awesome Sports
      'fas fa-football-ball', 'fas fa-basketball-ball', 'fas fa-baseball-ball',
      'fas fa-volleyball-ball', 'fas fa-golf-ball', 'fas fa-table-tennis',
      'fas fa-running', 'fas fa-skiing', 'fas fa-swimming-pool', 'fas fa-dumbbell',
      'fas fa-bicycle', 'fas fa-skating', 'fas fa-snowboarding', 'fas fa-hiking',
      
      // Material Design Icons Sports
      'mdi mdi-football', 'mdi mdi-basketball', 'mdi mdi-baseball', 'mdi mdi-volleyball',
      'mdi mdi-golf', 'mdi mdi-run', 'mdi mdi-swim', 'mdi mdi-dumbbell',
      'mdi mdi-bike', 'mdi mdi-ski', 'mdi mdi-snowboard',
      
      // Unicons Sports
      'uil uil-basketball', 'uil uil-football', 'uil uil-volleyball', 'uil uil-baseball',
      'uil uil-dumbbell', 'uil uil-swimmer', 'uil uil-running'
  ],

  transportation: [
      // Font Awesome Transportation
      'fas fa-car', 'fas fa-truck', 'fas fa-bus', 'fas fa-taxi', 'fas fa-motorcycle',
      'fas fa-bicycle', 'fas fa-train', 'fas fa-subway', 'fas fa-ship', 'fas fa-plane',
      'fas fa-helicopter', 'fas fa-space-shuttle', 'fas fa-rocket', 'fas fa-truck-moving',
      'fas fa-ambulance', 'fas fa-trailer', 'fas fa-truck-pickup', 'fas fa-caravan',
      
      // Material Design Icons Transportation
      'mdi mdi-car', 'mdi mdi-truck', 'mdi mdi-bus', 'mdi mdi-taxi', 'mdi mdi-motorbike',
      'mdi mdi-bike', 'mdi mdi-train', 'mdi mdi-subway', 'mdi mdi-ship', 'mdi mdi-airplane',
      'mdi mdi-helicopter', 'mdi mdi-rocket', 'mdi mdi-ambulance',
      
      // Unicons Transportation
      'uil uil-car', 'uil uil-truck', 'uil uil-bus', 'uil uil-taxi', 'uil uil-motorcycle',
      'uil uil-subway', 'uil uil-ship', 'uil uil-plane', 'uil uil-rocket'
  ],

  music: [
      // Font Awesome Music
      'fas fa-music', 'fas fa-guitar', 'fas fa-drum', 'fas fa-piano',
      'fas fa-microphone', 'fas fa-headphones', 'fas fa-volume-up', 'fas fa-record-vinyl',
      'fas fa-play', 'fas fa-pause', 'fas fa-stop', 'fas fa-forward', 'fas fa-backward',
      'fas fa-random', 'fas fa-repeat', 'fas fa-spotify', 'fas fa-itunes', 'fas fa-napster',
      
      // Material Design Icons Music
      'mdi mdi-music', 'mdi mdi-guitar-electric', 'mdi mdi-drum', 'mdi mdi-piano',
      'mdi mdi-microphone', 'mdi mdi-headphones', 'mdi mdi-volume-high', 'mdi mdi-disc',
      'mdi mdi-play', 'mdi mdi-pause', 'mdi mdi-stop', 'mdi mdi-skip-forward',
      
      // Unicons Music
      'uil uil-music', 'uil uil-guitar', 'uil uil-microphone', 'uil uil-headphones',
      'uil uil-volume-up', 'uil uil-play', 'uil uil-pause', 'uil uil-stop'
  ],

  gaming: [
      // Font Awesome Gaming
      'fas fa-gamepad', 'fas fa-dice', 'fas fa-chess', 'fas fa-chess-king',
      'fas fa-chess-queen', 'fas fa-chess-knight', 'fas fa-chess-bishop',
      'fas fa-chess-rook', 'fas fa-chess-pawn', 'fas fa-dice-d20', 'fas fa-dice-d6',
      'fas fa-puzzle-piece', 'fas fa-ghost', 'fas fa-trophy',
      
      // Material Design Icons Gaming
      'mdi mdi-gamepad', 'mdi mdi-dice-multiple', 'mdi mdi-chess-king',
      'mdi mdi-chess-queen', 'mdi mdi-chess-knight', 'mdi mdi-chess-bishop',
      'mdi mdi-chess-rook', 'mdi mdi-chess-pawn', 'mdi mdi-puzzle', 'mdi mdi-trophy',
      
      // Unicons Gaming
      'uil uil-game-structure', 'uil uil-dice-three', 'uil uil-chess',
      'uil uil-trophy', 'uil uil-puzzle-piece'
  ]
};

// Helper functions remain unchanged
function getIconType(icon) {
  if (icon.startsWith('fas') || icon.startsWith('far') || icon.startsWith('fab')) {
      return 'fontawesome';
  } else if (icon.startsWith('mdi')) {
      return 'material';
  } else if (icon.startsWith('uil')) {
      return 'unicons';
  }
  return 'unknown';
}

function getIconName(icon) {
  const parts = icon.split(' ');
  return parts[parts.length - 1].replace('fa-', '').replace('mdi-', '').replace('uil-', '');
}

// Export for use in other files
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
      iconCategories,
      getIconType,
      getIconName
  };
}

