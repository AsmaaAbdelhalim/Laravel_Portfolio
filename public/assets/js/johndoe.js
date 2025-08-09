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
