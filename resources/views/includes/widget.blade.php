<div class="col-lg-4">
    <div class="widget">
        <div class="search">
            <h6 class="search-header">Search the blog</h6>
            <form action="{{ route('search') }}" method="get">

                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="searchInput" placeholder="What are you looking for?">
                    <div class="input-group-append">
                        <button class="btn border-bottom" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="widget-posts">
            <h6 class="widget-header">Latest Posts</h6>

            @foreach ($latest_posts as $latest_post)
                <div class="widget-post d-flex align-items-center">
                    <div class="image"><img src="{{ asset('post-images') }}/{{ $latest_post->image }}" style="height: 50px" alt="..."></div>
                    <div class="widget-post-title">
                        <a href="/post/{{ $latest_post->id }}" class="text-dark"><strong>{{ $latest_post->title }}</strong></a>
                        <br>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="category">
            <h6 class="table-header">Categories</h6>
            <table class="table table-striped">
                @foreach ($categories as $category)    
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td class="text-right">{{ $category->posts->count() }}</td>
                    </tr>
                @endforeach

            </table>
        </div>

    </div>
</div>