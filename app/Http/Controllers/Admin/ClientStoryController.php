<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientStoryRequest;
use App\Http\Requests\UpdateClientStoryRequest;
use App\Models\ClientStory;
use App\Support\MediaStorage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class ClientStoryController extends Controller
{
    public function index(): View
    {
        return view('admin.client-stories.index');
    }

    public function create(): View
    {
        $story = new ClientStory([
            'is_featured' => true,
            'is_active' => false,
            'is_approved_for_public_use' => false,
            'sort_order' => (ClientStory::query()->max('sort_order') ?? 0) + 1,
            'poster_media_type' => 'image',
        ]);

        return view('admin.client-stories.form', compact('story'));
    }

    public function store(StoreClientStoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['video_file'], $data['poster_image_file'], $data['poster_animation_html_file']);
        $data['poster_media_type'] = $data['poster_media_type'] ?? 'image';

        if ($request->hasFile('video_file')) {
            try {
                $data['video_url'] = MediaStorage::storeVideo($request->file('video_file'), 'client-stories/videos');
            } catch (RuntimeException $e) {
                report($e);
                return back()->withInput()->withErrors(['video_file' => 'The video could not be saved.']);
            }
        }

        if ($request->hasFile('poster_image_file')) {
            try {
                $data['poster_image_url'] = MediaStorage::storeImage($request->file('poster_image_file'), 'client-stories/posters');
            } catch (RuntimeException $e) {
                report($e);
                return back()->withInput()->withErrors(['poster_image_file' => 'The poster image could not be saved.']);
            }
        }

        if ($request->hasFile('poster_animation_html_file')) {
            try {
                $data['poster_animation_html_url'] = MediaStorage::storeAnimationHtml($request->file('poster_animation_html_file'), 'client-stories/poster-animations');
                $data['poster_media_type'] = 'animation';
            } catch (RuntimeException $e) {
                report($e);
                MediaStorage::deleteManaged($data['video_url'] ?? null);
                MediaStorage::deleteManaged($data['poster_image_url'] ?? null);
                return back()->withInput()->withErrors(['poster_animation_html_file' => 'The poster HTML animation could not be saved.']);
            }
        }

        ClientStory::query()->create($data);

        return redirect()->route('admin.client-stories.index')->with('success', 'Client story created. It will only publish when Active and Public use approved are both enabled.');
    }

    public function edit(ClientStory $clientStory): View
    {
        return view('admin.client-stories.form', ['story' => $clientStory]);
    }

    public function update(UpdateClientStoryRequest $request, ClientStory $clientStory): RedirectResponse
    {
        $data = $request->validated();
        unset(
            $data['video_file'], $data['poster_image_file'], $data['poster_animation_html_file'],
            $data['remove_video'], $data['remove_poster_image'], $data['remove_poster_animation']
        );
        $data['poster_media_type'] = $data['poster_media_type'] ?? ($clientStory->poster_media_type ?: 'image');

        if (($data['video_url'] ?? null) === null || ($data['video_url'] ?? '') === '') {
            unset($data['video_url']);
        }

        if ($request->boolean('remove_video')) {
            MediaStorage::deleteManaged($clientStory->video_url);
            $data['video_url'] = null;
        } elseif ($request->hasFile('video_file')) {
            try {
                $new = MediaStorage::storeVideo($request->file('video_file'), 'client-stories/videos');
            } catch (RuntimeException $e) {
                report($e);
                return back()->withInput()->withErrors(['video_file' => 'The video could not be saved.']);
            }
            MediaStorage::deleteManaged($clientStory->video_url);
            $data['video_url'] = $new;
        } elseif (array_key_exists('video_url', $data) && $data['video_url'] !== $clientStory->video_url) {
            MediaStorage::deleteManaged($clientStory->video_url);
        }

        if ($request->boolean('remove_poster_image')) {
            MediaStorage::deleteManaged($clientStory->poster_image_url);
            $data['poster_image_url'] = null;
            $data['poster_image_alt'] = null;
        } elseif ($request->hasFile('poster_image_file')) {
            try {
                $new = MediaStorage::storeImage($request->file('poster_image_file'), 'client-stories/posters');
            } catch (RuntimeException $e) {
                report($e);
                return back()->withInput()->withErrors(['poster_image_file' => 'The poster image could not be saved.']);
            }
            MediaStorage::deleteManaged($clientStory->poster_image_url);
            $data['poster_image_url'] = $new;
        }

        if ($request->boolean('remove_poster_animation')) {
            MediaStorage::deleteManaged($clientStory->poster_animation_html_url);
            $data['poster_animation_html_url'] = null;
        } elseif ($request->hasFile('poster_animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('poster_animation_html_file'), 'client-stories/poster-animations');
            } catch (RuntimeException $e) {
                report($e);
                return back()->withInput()->withErrors(['poster_animation_html_file' => 'The poster HTML animation could not be saved.']);
            }
            MediaStorage::deleteManaged($clientStory->poster_animation_html_url);
            $data['poster_animation_html_url'] = $newAnimation;
            $data['poster_media_type'] = 'animation';
        }

        $clientStory->update($data);

        return redirect()->route('admin.client-stories.index')->with('success', 'Client story updated.');
    }

    public function destroy(ClientStory $clientStory): RedirectResponse
    {
        MediaStorage::deleteManaged($clientStory->video_url);
        MediaStorage::deleteManaged($clientStory->poster_image_url);
        MediaStorage::deleteManaged($clientStory->poster_animation_html_url);
        $clientStory->delete();

        return redirect()->route('admin.client-stories.index')->with('success', 'Client story deleted.');
    }
}
