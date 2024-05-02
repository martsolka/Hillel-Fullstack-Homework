<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;

class NewsController extends Controller
{
    const DEFAULT_PER_PAGE = 7;
    const DEFAULT_SORT = 'created';
    const DEFAULT_SORT_DIRECTION = 'desc';
    const SORT_COLUMNS = [
        ['label' => '📃 News title', 'value' => 'title', 'column' => 'news.title'],
        ['label' => '👤 Author name', 'value' => 'author', 'column' => 'users.name'],
        ['label' => '📅 Date of creation', 'value' => 'created', 'column' => 'news.created_at'],
        ['label' => '💬 Count of comments', 'value' => 'comments', 'column' => 'comments_count'],
        ['label' => '👍 Count of likes', 'value' => 'likes', 'column' => 'likes_count'],
    ];

    public function index()
    {
        $sortFromRequest = request()->get('sort', self::DEFAULT_SORT);
        $dirFromRequest = request()->get('direction', self::DEFAULT_SORT_DIRECTION);
        $sortValuesWithLabels = collect(self::SORT_COLUMNS)->pluck('label', 'value');
        $sortColumns = collect(self::SORT_COLUMNS)->pluck('column', 'value');

        $newsArr = News::query()
            ->with([
                'likes' => fn (Relation $query) => $query->with(['user' => fn ($query) => $query->withCount('news', 'comments', 'likes')]),
                'comments' => fn (Relation $query) => $query
                    ->with([
                        'user' => fn ($query) => $query->withCount('news', 'comments', 'likes')
                    ])
                    ->orderBy('created_at', 'desc'),
                'user:id,name',
            ])
            ->withCount('comments', 'likes')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->when(
                $search = request()->get('search'),
                fn ($query) => $query->where('news.title', 'like', '%' . $search . '%')->orWhere('users.name', 'like', '%' . $search . '%')
            )
            ->orderBy($sortColumns[$sortFromRequest], $dirFromRequest)
            ->paginate(self::DEFAULT_PER_PAGE);

        return view('news.index', compact('newsArr', 'sortValuesWithLabels', 'sortFromRequest', 'dirFromRequest'));
    }
}
