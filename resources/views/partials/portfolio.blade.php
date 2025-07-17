<!-- Portfolio Section -->
<section class="section bg-custom-gray" id="portfolio">
    <div class="container">
        <h1 class="mb-5"><span class="text-danger">My</span> Portfolio</h1>
        <div class="portfolio">
            @foreach($portfolios as $portfolio)
                <!-- Filters -->
                <div class="filters" data-portfolio-id="{{ $portfolio->id }}">
                    <a href="#" class="filter-link active" data-category-id="0" data-portfolio-id="{{ $portfolio->id }}">All</a>
                    @foreach($portfolio->categories as $category)
                        <a href="#" class="filter-link" data-category-id="{{ $category->id }}" data-portfolio-id="{{ $portfolio->id }}">{{ $category->name }}</a>
                    @endforeach
                </div>

                <!-- Projects -->
                <div class="portfolio-container" id="portfolio-container-{{ $portfolio->id }}">
                    @include('partials.projects', ['projects' => $portfolio->paginatedProjects, 'path' => $path])
                </div>
            @endforeach
        </div>
    </div>
</section>