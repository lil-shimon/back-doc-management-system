<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentResourceCollection;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Attachment $attachment
     * @return AttachmentResource
     */
    public function show(Attachment $attachment): AttachmentResource
    {
        return new AttachmentResource($attachment);
    }

    /**
     * Undocumented function
     *
     * @return AttachmentResourceCollection
     */
    public function index(): AttachmentResourceCollection
    {
        return new AttachmentResourceCollection(Attachment::paginate());
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_path'
        ]);

        $attachment = Attachment::create($request->all());
        return new AttachmentResource($attachment);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Attachment $attachment
     * @return AttachmentResource
     */
    public function update(Request $request, Attachment $attachment): AttachmentResource
    {
        $attachment->update($request->all());
        return new AttachmentResource($attachment);
    }

    /**
     * Undocumented function
     *
     * @param Attachment $attachment
     * @return void
     */
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return response()->json();
    }
}
