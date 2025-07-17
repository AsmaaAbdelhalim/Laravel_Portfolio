<div>
    <h2>Debug: Projects Count: {{ $projects->count() }}</h2>
</div>

<div class="row">
    @forelse($projects as $project)
        <div class="col-md-6 col-lg-4 project" data-category-id="{{ $project->category_id }}">
            <div class="portfolio-item" data-toggle="modal" data-target="#projectModal-{{ $project->id }}">
                <img src="{{ Storage::url( $path .'/'.$project->image) }}" class="img-fluid" alt="{{ $project->name }}">
                <div class="content-holder">
                    <div class="text-holder">
                        <h6 class="title">{{ $project->name }}</h6>
                        <p class="subtitle">{{ \Illuminate\Support\Str::limit($project->description, 50) }}</p>
                        {{ $project->views }} <i class="uil uil-eye"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Modal -->
        <div class="modal fade" id="projectModal-{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel-{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="projectModalLabel-{{ $project->id }}">{{ $project->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ Storage::url( $path . '/' . $project->image) }}" class="img-fluid" alt="{{ $project->name }}">
                            </div>
                            <div class="col-md-6">
                                <h6 class="title">{{ $project->name }}</h6>
                                <p class="subtitle">{{ $project->description }}</p>
                                <p><strong>Category:</strong> {{ $project->category->name }}</p>
                                @if($project->url)
                                    <p><strong>URL:</strong> <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a></p>
                                @endif
                            </div>
                        </div>

                        @if($project->images->isNotEmpty())
                            <hr>
                            <h5>Additional Images</h5>
                            <div class="row">
                                @foreach($project->images as $image)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ Storage::url( $path . '/' . $image->image) }}" class="img-fluid" alt="Additional Image for {{ $project->name }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p>No projects found.</p>
        </div>
    @endforelse
</div>

@if ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
    <div class="pagination justify-content-center mt-4">
        {{ $projects->links('layouts.custom-pagination') }}
    </div>
@endif