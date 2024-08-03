<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MediaSosial\DeleteMediaSosialRequest;
use App\Http\Requests\Dashboard\MediaSosial\MediaSosialRequest;
use App\Http\Requests\Dashboard\MediaSosial\StoreMediaSosialRequest;
use App\Http\Requests\Dashboard\MediaSosial\UpdateMediaSosialRequest;
use App\Models\MediaSosial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaSosialController extends Controller
{
    /**
     * Menampilkan halaman utama media sosial
     *
     * @param MediaSosialRequest $request
     * @return JsonResponse|View
     */
    public function index(MediaSosialRequest $request): JsonResponse|View
    {
        if ($request->ajax()) {
            return $request->dataTable();
        }

        return view('pages.dashboard.media-sosial.index');
    }

    /**
     * Menampilkan halaman tambah data media sosial.
     *
     * @return View
     */
    public function create(): View
    {
        $icons = [
            "bi-alexa",
            "bi-behance",
            "bi-discord",
            "bi-dribbble",
            "bi-facebook",
            "bi-github",
            "bi-gitlab",
            "bi-google",
            "bi-instagram",
            "bi-line",
            "bi-linkedin",
            "bi-mastodon",
            "bi-medium",
            "bi-messenger",
            "bi-microsoft-teams",
            "bi-opencollective",
            "bi-paypal",
            "bi-pinterest",
            "bi-quora",
            "bi-reddit",
            "bi-signal",
            "bi-sina-weibo",
            "bi-skype",
            "bi-slack",
            "bi-snapchat",
            "bi-sourceforge",
            "bi-spotify",
            "bi-stack-overflow",
            "bi-strava",
            "bi-substack",
            "bi-telegram",
            "bi-tencent-qq",
            "bi-threads",
            "bi-threads-fill",
            "bi-tiktok",
            "bi-twitch",
            "bi-twitter",
            "bi-twitter-x",
            "bi-vimeo",
            "bi-wechat",
            "bi-whatsapp",
            "bi-wordpress",
            "bi-yelp",
            "bi-youtube",
        ];

        return view('pages.dashboard.media-sosial.create', compact('icons'));
    }

    /**
     * Tambah data media sosial ke database.
     *
     * @param StoreMediaSosialRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMediaSosialRequest $request): RedirectResponse
    {
        $request->insert();

        return to_route('dashboard.mediaSosial.create')->with('alert', [
            'variant' => 'success',
            'message' => 'Media sosial berhasil ditambahkan.'
        ]);
    }

    /**
     * Menampilkan halaman edit data media sosial.
     *
     * @return View
     */
    public function edit(MediaSosial $mediaSosial): View
    {
        $icons = [
            "bi-alexa",
            "bi-behance",
            "bi-discord",
            "bi-dribbble",
            "bi-facebook",
            "bi-github",
            "bi-gitlab",
            "bi-google",
            "bi-instagram",
            "bi-line",
            "bi-linkedin",
            "bi-mastodon",
            "bi-medium",
            "bi-messenger",
            "bi-microsoft-teams",
            "bi-opencollective",
            "bi-paypal",
            "bi-pinterest",
            "bi-quora",
            "bi-reddit",
            "bi-signal",
            "bi-sina-weibo",
            "bi-skype",
            "bi-slack",
            "bi-snapchat",
            "bi-sourceforge",
            "bi-spotify",
            "bi-stack-overflow",
            "bi-strava",
            "bi-substack",
            "bi-telegram",
            "bi-tencent-qq",
            "bi-threads",
            "bi-threads-fill",
            "bi-tiktok",
            "bi-twitch",
            "bi-twitter",
            "bi-twitter-x",
            "bi-vimeo",
            "bi-wechat",
            "bi-whatsapp",
            "bi-wordpress",
            "bi-yelp",
            "bi-youtube",
        ];

        return view('pages.dashboard.media-sosial.edit', compact('icons', 'mediaSosial'));
    }

    /**
     * Update data media sosial ke database.
     *
     * @param UpdateMediaSosialRequest $request
     * @param MediaSosial $mediaSosial
     * @return RedirectResponse
     */
    public function update(UpdateMediaSosialRequest $request, MediaSosial $mediaSosial): RedirectResponse
    {
        $request->update();

        return to_route('dashboard.mediaSosial')->with('alert', [
            'variant' => 'success',
            'message' => 'Media sosial berhasil diperbarui.'
        ]);
    }

    /**
     * Hapus data media sosial dari database.
     *
     * @param DeleteMediaSosialRequest $request
     * @param MediaSosial $mediaSosial
     * @return RedirectResponse
     */
    public function destroy(DeleteMediaSosialRequest $request, MediaSosial $mediaSosial): RedirectResponse
    {
        $request->destroy();

        return to_route('dashboard.mediaSosial')->with('alert', [
            'variant' => 'success',
            'message' => 'Media sosial berhasil dihapus.'
        ]);
    }
}
