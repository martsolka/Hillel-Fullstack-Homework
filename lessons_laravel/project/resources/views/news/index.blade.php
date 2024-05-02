<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>News | Index Page</title>
  <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css')}} " rel="stylesheet">
</head>

<body class="vh-100 bg-gradient-1 d-flex">
  <div class="container-lg my-auto py-4 h-100">
    <div class="card bg-body bg-opacity-50 shadow-sm border-0 col-lg-8 mx-auto h-100">
      <div class="card-header bg-body bg-opacity-50 border-0 shadow-sm">
        <div class="row align-items-center justify-content-center row-gap-2">
          <div class="col-auto col-sm-4">
            <h1 class="mb-0 fs-3 text-nowrap">
              <a class="text-decoration-none" href="{{ route('news.index') }}" title="News Listing">📃</a> News Listing
            </h1>
          </div>

          <div class="col-12 col-sm">
            <div class="input-group flex-nowrap">
              <form action="{{ route('news.index') }}" method="GET" role="search" id="search-form" class="input-group mb-0">
                <label for="search" class="input-group-text">🔎</label>
                <input type="text" name="search" id="search" class="form-control shadow-none rounded-end-0" placeholder="Search by news title or author name..." value="{{ request()->get('search') }}" autocomplete="off" required>
                @if(request()->has('search'))
                <a href="{{ route('news.index') }}" class="btn link-dark fw-medium text-nowrap">Clear</a>
                @endif
              </form>

              <button class="btn btn-light border fw-medium text-nowrap dropdown-toggle" type="button" id="dropdown-sort" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Sort by: <small>{{ $sortFromRequest }}</small></button>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-sort">
                <form action="{{ route('news.index') }}" method="GET">
                  <ul class="list-group list-group-flush">
                    @foreach($sortValuesWithLabels as $value => $label)
                    <li class="list-group-item list-group-item-action">
                      <input class="form-check-input" type="radio" name="sort" value="{{ $value }}" id="sort-{{ $value }}" autocomplete="off" @checked($sortFromRequest===$value)>
                      <label class="form-check-label stretched-link fw-medium ms-1 small" for="sort-{{ $value }}">
                        {{ $label }}
                      </label>
                    </li>
                    @endforeach

                    <li class="list-group-item d-flex gap-2">
                      <input type="radio" class="btn-check" name="direction" value="desc" id="sort-desc" autocomplete="off" @checked($dirFromRequest==='desc' )>
                      <label class="btn btn-sm btn-light border fw-medium text-nowrap flex-grow-1" for="sort-desc">
                        ▼ DESC
                      </label>

                      <input type="radio" class="btn-check" name="direction" value="asc" id="sort-asc" autocomplete="off" @checked($dirFromRequest==='asc' )>
                      <label class="btn btn-sm btn-light border fw-medium text-nowrap flex-grow-1" for="sort-asc">
                        ▲ ASC
                      </label>
                    </li>

                    <li class="list-group-item">
                      <button type="submit" class="btn btn-sm btn-light border fw-medium text-nowrap w-100">
                        ✔ Apply Selected
                      </button>
                    </li>

                    <li class="list-group-item list-group-item-action">
                      <a href="{{ route('news.index') }}" class="btn btn-sm link-secondary fw-medium text-nowrap small w-100">

                        ↻ Reset to Default
                      </a>
                    </li>
                  </ul>
                </form>

              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="card-body d-grid gap-3 overflow-y-auto">
        @forelse($newsArr as $news)
        <article class="card bg-body bg-opacity-50 shadow-sm border-0">
          <div class="row g-0">
            <figure class="col-md-4 flex-grow-1 mb-0 p-3 pb-0 p-md-0">
              <img src="{{ $news->banner }}" class="w-100 h-100 object-fit-cover" height="200" alt="{{ $news->title }}">
            </figure>

            <div class="col-md-8 flex-grow-1">
              <div class="card-body">
                <h3 class="card-title">
                  <a class="link-body-emphasis text-decoration-none sretched-link" href="#">
                    {{ $news->title }}
                  </a>
                </h3>

                <p class="mb-2  position-relative z-3">
                  ✦ By
                  <a class="fw-medium link-body-emphasis" href="#{{ $news->user->id }}">
                    {{ $news->user->name }}
                  </a>
                  ✦
                  <small class="opacity-75">
                    @if($news->updated_at)
                    Modified: {{ date('F j, Y, g:i a', strtotime($news->updated_at)) }}
                    @else
                    Created: {{ date('F j, Y, g:i a', strtotime($news->created_at)) }}
                    @endif
                  </small>
                </p>

                <p class="card-text">
                  {{ Str::limit($news->content, 125) }}
                </p>

                <div class="btn-group">
                  <div class="dropdown">
                    <button id="dropdown-likes" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" title="View Likes">
                      👍 <small>{{ $news->likes_count }} likes</small>
                    </button>

                    <div class="dropdown-menu mh-px-400 overflow-y-auto p-0" aria-labelledby="dropdown-likes">
                      @if($news->likes_count > 0)
                      <h4 class="dropdown-header">Users who liked this news:</h4>

                      <div class="accordion accordion-flush" id="accordion-likes">
                        @foreach($news->likes as $like)
                        <div class="accordion-item">
                          <h5 class="accordion-header">
                            <button class="accordion-button flex-wrap-reverse flex-lg-nowrap collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-likes-collapse-{{ $like->id }}" aria-expanded="false" aria-controls="accordion-likes-collapse-{{ $like->id }}">
                              <span class="fw-medium text-nowrap">#{{ $loop->iteration }} {{ $like->user->name }}</span>

                              <span class="badge fw-normal bg-light bg-opacity-50 text-light-emphasis mx-2">
                                👍 {{ $like->liked_at }}
                              </span>
                            </button>
                          </h5>

                          <div class="accordion-collapse collapse" id="accordion-likes-collapse-{{ $like->id }}" data-bs-parent="#accordion-likes">
                            <div class="accordion-body p-2">
                              <div class="hstack justify-content-between gap-2 text-center lh-1 small">
                                <h6 class="mb-0">User Stats:</h6>

                                <div class="d-grid gap-1">
                                  <strong>{{ $like->user->news_count }}</strong>
                                  <small>Posted News</small>
                                </div>

                                <div class="vr"></div>

                                <div class="d-grid gap-1">
                                  <strong>{{ $like->user->likes_count }}</strong>
                                  <small>Liked News</small>
                                </div>

                                <div class="vr"></div>

                                <div class="d-grid gap-1">
                                  <strong>{{ $like->user->comments_count }}</strong>
                                  <small>Left Comments</small>
                                </div>

                                <a class="btn btn-sm btn-light border" href="#">View Profile</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                      @else
                      <small class="d-block p-1 text-muted">No likes yet...</small>
                      @endif
                    </div>
                  </div>

                  <div class="dropdown">
                    <button id="dropdown-comments" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" title="View comments">
                      💬 <small>{{ $news->comments_count }} comments</small>
                    </button>

                    <div class="dropdown-menu mh-px-400 overflow-y-auto" aria-labelledby="dropdown-comments">
                      @if($news->comments_count > 0)
                      <h4 class="dropdown-header">All comments:</h4>

                      <ul class="list-group list-group-flush">
                        @foreach($news->comments as $comment)
                        <li class="list-group-item">
                          <div class="hstack justify-content-between flex-wrap-reverse flex-lg-nowrap">
                            <button class="btn fw-medium text-nowrap" type="button" data-bs-toggle="collapse" data-bs-target="#user-comment-collapse-{{ $comment->id }}" aria-expanded="false" aria-controls="user-comment-collapse-{{ $comment->id }}">#{{ $loop->iteration }} {{ $comment->user->name }}</button>

                            <span class="badge fw-normal bg-light bg-opacity-50 text-light-emphasis mx-2">
                              💬 {{ $comment->created_at }}
                            </span>
                          </div>

                          <div class="collapse" id="user-comment-collapse-{{ $comment->id }}">
                            <div class="hstack justify-content-between gap-2 text-center lh-1 small">
                              <h6 class="mb-0">User Stats:</h6>

                              <div class="d-grid gap-1">
                                <strong>{{ $comment->user->news_count }}</strong>
                                <small>Posted News</small>
                              </div>

                              <div class="vr"></div>

                              <div class="d-grid gap-1">
                                <strong>{{ $comment->user->likes_count }}</strong>
                                <small>Liked News</small>
                              </div>

                              <div class="vr"></div>

                              <div class="d-grid gap-1">
                                <strong>{{ $comment->user->comments_count }}</strong>
                                <small>Left Comments</small>
                              </div>

                              <a class="btn btn-sm btn-light border" href="#">View Profile</a>
                            </div>
                          </div>

                          <div>{{ $comment->content }}</div>
                        </li>
                        @endforeach
                      </ul>
                      @else
                      <small class="d-block p-1 text-muted">No comments yet...</small>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="d-flex flex-wrap row-gap-1 column-gap-3">
                    <a class="btn btn-light border fw-medium flex-grow-1" href="#">
                      Read More ➜
                    </a>

                    <div class="btn-group flex-grow-1">
                      <button class="btn btn-light border " type="button">
                        👍 Like
                      </button>

                      <button class="btn btn-light border " type="button">
                        📢 Share
                      </button>

                      <button class="btn btn-light border " type="button">
                        💬 Comment
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </article>
        @empty
        <p class="card-text lead text-center">👀 No News Found ...</p>
        @endforelse
      </div>

      @if($newsArr->hasPages())
      <div class="card-footer flex-shrink-0 pagination-dark">
        {{ $newsArr->withQueryString()->links() }}
      </div>
      @endif
    </div>
  </div>

  <script src="https://fastly.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script>
</body>

</html>
