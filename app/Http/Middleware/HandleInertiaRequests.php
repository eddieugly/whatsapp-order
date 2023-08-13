<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\General;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Resources\GeneralResource;
use Illuminate\Support\Facades\DB;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $firstLoadOnlyProps = $request->user()?->can('manage order') ? ['orderNoticeCount' => DB::table('notifications')->whereNull('read_at')->count()] : [];

        return array_merge(parent::share($request), $firstLoadOnlyProps, [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error')
            ],
            'general' => new GeneralResource(General::first()),
            'slider_menues' => MenuResource::collection(Menu::active()->onSlider()->inRandomOrder()->limit(8)->get()),
        ]);
    }
}
